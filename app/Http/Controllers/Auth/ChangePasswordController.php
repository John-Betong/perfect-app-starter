<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Validation\FormValidation;
use PDO;
use PerfectApp\Database\PdoCrud;

/**
 * Class ChangePasswordController
 * @package App\Controllers
 */
class ChangePasswordController
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var FormValidation
     */
    private FormValidation $validate;

    /**
     * @var array
     */
    private array $allowedFields = [
          'current_password'
        , 'password'
        , 'password_confirm'
    ];

    /**
     * @var array
     */
    private $requiredFields = [
          'current_password'
        , 'password'
        , 'password_confirm'
    ];


    /**
     * ChangePasswordController constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = new PdoCrud($pdo);
        $this->validate = new FormValidation();
    }

    /**
     * * Show the form for creating a new resource.
     *
     */
    final public function create(): void
    {
        view(
            'layouts/layout-admin',
            [
                  'templatePage' => 'auth/passwords/form-change-password'
                , 'errorResult' => ''
            ]
        );
    }

    /**
     *
     */
    final public function update(): void
    {
        //------------------------------------------------------------------------------------
        // Trim Data
        //------------------------------------------------------------------------------------

        $_POST = trim_array($_POST);

        //------------------------------------------------------------------------------------
        // Whitelist Form Fields
        //------------------------------------------------------------------------------------

        $this->validate->validateWhiteList($this->allowedFields, $_POST);

        //------------------------------------------------------------------------------------
        // Check Required Fields
        //------------------------------------------------------------------------------------

        $this->validate->requiredFieldCheck($this->requiredFields, $_POST);
        $this->validate->validatePasswordConfirm();

        $error = $this->validate->getErrors();

        //------------------------------------------------------------------------------------
        // Check for errors
        //------------------------------------------------------------------------------------

        if (!$error) {
            $sql = 'SELECT password FROM users WHERE user_id = ?';
            $row = $this->pdo->prepareExecuteQuery($sql, [$_SESSION['user_id']])->fetch();

            if (!password_verify($_POST['current_password'], $row['password'])) {
                $error[] = 'Current Password Incorrect';
                $this->validate->setError($error);
            }

            $error = $this->validate->getErrors();

            if (!$error) {
                $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = 'UPDATE users SET password = ? WHERE user_id = ?';
                $this->pdo->prepareExecuteQuery($sql, [$hashed_password, $_SESSION['user_id']]);
                redirect('logout');
            }
        }

        $errorResult = $this->validate->displayErrors();

        view(
            'layouts/layout-admin',
            [
                  'templatePage' => 'auth/passwords/form-change-password'
                , 'error' => $error
                , 'errorResult' => $errorResult
            ]
        );
    }
}
