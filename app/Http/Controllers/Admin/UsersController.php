<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;


use InvalidArgumentException;
use PDOException;
use PerfectApp\Utilities\Flash;
use UnexpectedValueException;

// index, store, create, update, destroy, show, edit.

/**
 * Class UsersController
 * @package App\Controllers
 */
class UsersController extends UsersBaseController
{
    /**
     *
     */
    final public function index(): void
    {
        $sql = "SELECT
         u.user_id
       , u.username
       , u.email
       , u.first_name
       , u.last_name
       , u.last_login
       , u.role_id
       , r.role_description
       , IF(u.is_active = TRUE, 'Active', 'Inactive') AS is_active
       , IF(u.is_email_verified = TRUE, 'Yes', 'No') AS is_email_verified
FROM
users AS u
INNER JOIN roles AS r ON u.role_id = r.role_id";

        $stmt = $this->db->pdoQuery($sql);
        $result = $stmt->fetchAll();
        view(
            $this->layoutPath,
            [
                  'templatePage' => 'admin/users/list-users'
                , 'stmt' => $stmt
                , 'result' => $result
                , 'db' => $this->db
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    final public function store(): void
    {
        if (isset($_POST['new']))
        {
            $redirectPath = 'add-user';
            unset($_POST['new']);
        }
        else
        {
            $redirectPath = 'list-users';
        }

        $error = $this->preChecks();

        if (!$error)
        {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $error = $this->persistData('insert');
        }

        if ($error)
        {
            $errorResult = $this->validate->displayErrors();
            view(
                $this->layoutPath,
                [
                      'templatePage' => $this->templatePath
                    , 'form_data' => $_POST
                    , 'uri' => $this->uri
                    , 'errorResult' => $errorResult
                    , 'db' => $this->db
                    , 'error' => $error
                    , 'roles' => $this->getRoles()
                ]
            );
            die;
        }

        Flash::addmessage(ACTIONS_ARRAY['insert']['message'], ACTIONS_ARRAY['insert']['status']);
        redirect($redirectPath);
    }

    /**
     * * Show the form for creating a new resource.
     *
     */
    final public function create(): void
    {
        view(
            $this->layoutPath,
            [
                  'templatePage' => $this->templatePath
                , 'post' => '$_POST'
                , 'uri' => $this->uri
                , 'roles' => $this->getRoles()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     */
    final public function update(): void
    {
        if (!ctype_digit($_POST['id']))
        {
            throw new InvalidArgumentException('Invalid ID');
        }

        if (isset($_POST['new']))
        {
            $redirectPath = 'add-user';
            unset($_POST['new']);
        }
        else
        {
            $redirectPath = 'list-users';
        }

        $error = $this->preChecks();

        if (!$error)
        {
            $error = $this->persistData('update');
        }

        if ($error)
        {
            $errorResult = $this->validate->displayErrors();

            view($this->layoutPath, [
                  'templatePage' => $this->templatePath
                , 'form_data' => $_POST
                , 'uri' => $this->uri
                , 'errorResult' => $errorResult
                , 'db' => $this->db
                , 'error' => $error
                , 'roles' => $this->getRoles()
                ]);
            die;
        }

        Flash::addmessage(ACTIONS_ARRAY['update']['message'], ACTIONS_ARRAY['update']['status']);
        redirect($redirectPath);
    }

    /**
     * * Show the form for editing the specified resource.
     *
     */
    final public function edit(): void
    {
        if (!isset($_GET['id']))
        {
            throw new InvalidArgumentException('Invalid ID');
        }

        if (!ctype_digit($_GET['id']))
        {
            throw new InvalidArgumentException('Invalid ID');
        }

        if ($_GET['id'] < 1)
        {
        throw new InvalidArgumentException('Invalid ID');
        }

        $stmt = $this->db->findById('users', 'user_id', $_GET['id']);
        $row = $stmt->fetch();

        if (!$row)
        {
            throw new InvalidArgumentException('Invalid ID');
        }

        view(
            $this->layoutPath,
            [
                  'templatePage' => $this->templatePath
                , 'form_data' => $row
                , 'uri' => $this->uri
                , 'roles' => $this->getRoles()
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    final public function destroy(): void
    {
        /*  Delete Rules
        * Id required
        * Id must be a number only
        * Id must be a number in the table
        * Id must NOT be same as logged in user
        * Optional: User must have permission to delete this id
        */

        if (!ctype_digit($_GET['id']))
        {
            throw new InvalidArgumentException('Invalid ID');
        }

        //$_GET['id'] is string, $_SESSION['user_id'] is int
        if ($_GET['id'] == $_SESSION['user_id'])
        {
            Flash::addmessage(ACTIONS_ARRAY['user-delete-error']['message'], ACTIONS_ARRAY['user-delete-error']['status']);
            redirect('list-users');
        }

        $del = $this->db->delete('users', 'user_id', $_GET['id']);

        if (!$del)
        {
            throw new UnexpectedValueException("ID {$_GET['id']} does not exist");
        }

        Flash::addmessage(ACTIONS_ARRAY['delete']['message'], ACTIONS_ARRAY['delete']['status']);
        redirect('list-users?action=delete');
    }

    /**
     * @param $action
     * @return array
     */
    private function persistData(string $action): array
    {
        $error = [];
        try
        {
            if ($action === 'insert')
            {
                $this->db->insert('users', $_POST);
            }
            if ($action === 'update')
            {
                $this->db->update('users', 'user_id', $_POST);
            }
        }
        catch (PDOException $e)
        {
            if ($e->getCode() === '23000')
            {
                $error['email'] = 'Invalid Username or Email';
                $this->validate->setError($error);
                $errorResult = $this->validate->displayErrors();

                view(
                    $this->layoutPath,
                    [
                          'templatePage' => $this->templatePath
                        , 'form_data' => $_POST
                        , 'uri' => $this->uri
                        , 'error' => $error
                        , 'errorResult' => $errorResult
                        , 'db' => $this->db
                        , 'roles' => $this->getRoles()
                    ]
                );
                die;
            }
            throw $e;
        }
        return $error;
    }

    /**
     * @return array
     */
    private function getRoles(): array
    {
    return $this->db->pdoQuery('SELECT role_id, role_description FROM roles')->fetchAll();
    }
}
