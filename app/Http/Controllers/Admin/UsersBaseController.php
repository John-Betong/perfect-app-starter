<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Validation\FormValidation;
use PDO;
use PerfectApp\Database\PdoCrud;

/**
 * Class UsersBaseController
 * @package App\Http\Controllers\Auth
 */
class UsersBaseController
{
    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var PdoCrud
     */
    protected PdoCrud $db;

    /**
     * @var FormValidation
     */
    protected FormValidation $validate;

    /**
     * @var string
     */
    protected string $templatePath = 'admin/users/form-users';

    /**
     * @var string
     */
    protected string $layoutPath = 'layouts/layout';

    /**
     * @var string
     */
    protected string $uri;

    /**
     * @var array
     */
    protected array $allowedFields = [
        'is_active'
        ,
        'role_id'
        ,
        'username'
        ,
        'password'
        ,
        'email'
        ,
        'first_name'
        ,
        'last_name'
        ,
        'owned_by'
        ,
        'id'
        ,
        'new'
    ];

    /**
     * @var array
     */
    protected array $requiredFields = [
        'role_id'
        ,
        'first_name'
        ,
        'last_name'
        ,
        'email'
        ,
        'username'
        ,
        'password'
    ];

    /**
     * UsersBaseController constructor.
     * @param PDO $pdo
     * @param string $uri
     */
    public function __construct(PDO $pdo, string $uri)
    {
        $this->pdo = $pdo;
        $this->uri = $uri;
        $this->db = new PdoCrud($pdo);
        $this->validate = new FormValidation();
    }

    /**
     * @return array
     */
    final public function preChecks(): array
    {
        $_POST = trim_array($_POST);
        $_POST['is_active'] = $_POST['is_active'] ?? '0';
        $this->validate->validateWhiteList($this->allowedFields, $_POST);
        $this->validate->requiredFieldCheck($this->requiredFields, $_POST);
        $this->validate->validateEmail();
        return $this->validate->getErrors();
    }
}
