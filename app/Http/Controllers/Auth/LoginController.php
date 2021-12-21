<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use PDO;
use PerfectApp\Database\PdoCrud;
use PerfectApp\Form\ValidateFormRequiredWhitelist;
use PerfectApp\Logging\SQLLoginAttemptsLog;
use PerfectApp\Utilities\Flash;

/**
 * Class LoginController
 * @package App\Controllers
 */
class LoginController
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @var ValidateFormRequiredWhitelist
     */
    private ValidateFormRequiredWhitelist $validate;

    /**
     * @var string
     */
    private string $templatePath = 'auth/form-login';

    /**
     * @var array
     */
    private array $allowedFields = [
          'username'
        , 'password'
    ];

    /**
     * @var array
     */
    private array $requiredFields = [
          'username'
        , 'password'
    ];

    /**
     * LoginController constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->validate = new ValidateFormRequiredWhitelist();
    }

    /**
     *
     */
    final public function showLogin(): void
    {
        FLASH::displayMessages();
        view('auth/passwords/login', ['templatePage' => $this->templatePath]);
    }

    /**
     *
     */
    final public function doLogin(): void
    {
        $_POST = trim_array($_POST);

        $this->validate->validateWhiteList($this->allowedFields, $_POST);
        $error = $this->validate->requiredFieldCheck($this->requiredFields, $_POST);

        if ($error)
        {
            view('auth/passwords/login', ['templatePage' => $this->templatePath, 'error' => $error]);
            die;
        }

        $login_status = false;
        $login_attempt = new SQLLoginAttemptsLog($this->pdo);

        $db = new PdoCrud($this->pdo);
        $sql = 'SELECT 
                    user_id
                  , password
                  , first_name
                  , last_name
                  , is_active
                  , is_email_verified
            FROM  users
            WHERE username = ?';

        $row = $db->prepareExecuteQuery($sql, [$_POST['username']])->fetch();

        if (!$row || !password_verify($_POST['password'], $row['password']))
        {
            $login_status = 'failed_login';
        }
        elseif (!$row['is_email_verified'])
        {
            $login_status = 'noconfirm';
        }
        elseif (!$row['is_active'])
        {
            $login_status = 'inactive';
        }

        if ($login_status)
        {
            $login_attempt->logFailedAttempt($_POST['username']);
            Flash::addmessage(ACTIONS_ARRAY[$login_status]['message'], ACTIONS_ARRAY[$login_status]['status']);
            redirect('./login');
        }

        //----------------------------------------------------------------------------
        // Log successful login attempt & Update Last Login Datetime
        //----------------------------------------------------------------------------

        $login_attempt->logSuccessfulAttempt($_POST['username']);

        $sql = 'UPDATE users SET last_login = NOW() WHERE username = ?;';
        $db->prepareExecuteQuery($sql, [$_POST['username']]);

        //----------------------------------------------------------------------------
        // Set Session Variables
        //----------------------------------------------------------------------------

        session_regenerate_id(true);

        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        redirect('./');
    }

    /**
     *
     */
    final public function logout(): void
    {
        //Remove PHPSESSID from browser
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        $_SESSION = [];//clear session from globals
        session_destroy();//clear session from disk
        Flash::addmessage(ACTIONS_ARRAY['logout']['message'], ACTIONS_ARRAY['logout']['status']);
        view('auth/passwords/logout', ['templatePage' => $this->templatePath]);
    }
}
