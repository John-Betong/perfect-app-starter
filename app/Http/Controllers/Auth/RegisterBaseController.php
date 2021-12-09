<?php declare(strict_types=1);


namespace App\Http\Controllers\Auth;

use App\Validation\FormValidation;
use PDO;
use PerfectApp\Database\PdoCrud;
use PerfectApp\Mail\PHPMailSubmissionAgent;
use PerfectApp\Utilities\TokenGenerator;


class RegisterBaseController
{
    /**
     * @var FormValidation
     */
    protected FormValidation $validate;

    /**
     * @var string
     */
    protected string $templatePath = 'auth/form-register';

    /**
     * @var array
     */
    protected array $allowedFields = [
          'first_name'
        , 'last_name'
        , 'email'
        , 'username'
        , 'password'
        , 'password_confirm'
    ];

    /**
     * @var array
     */
    protected $requiredFields = [
          'first_name'
        , 'last_name'
        , 'email'
        , 'username'
        , 'password'
        , 'password_confirm'
    ];

    public function __construct()
    {
        $this->validate = new FormValidation();
        $this->tokenGenerator = new TokenGenerator();
    }

    /**
     * @return array
     */
    final public function preChecks(): array
    {
        $_POST = trim_array($_POST);
        $this->validate->validateWhiteList($this->allowedFields, $_POST);
        $this->validate->requiredFieldCheck($this->requiredFields, $_POST);
        $this->validate->validateEmail();
        $this->validate->validatePasswordConfirm();
        return $this->validate->getErrors();
    }
}
