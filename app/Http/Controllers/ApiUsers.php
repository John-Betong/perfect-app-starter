<?php declare(strict_types=1);

namespace App\Http\Controllers;

use JsonException;
use PerfectApp\Database\PdoCrud;
use PDO;

/**
 * Class ApiUsers
 * @package App\Http\Controllers
 */
class ApiUsers
{
    /**
     * @var PdoCrud
     */
    private PdoCrud $pdo;

    /**
     * @var string
     */
    public string $uri;

    /**
     * ApiUsers constructor.
     * @param PDO $pdo
     * @param string $uri
     */
    public function __construct(PDO $pdo, string $uri)
    {
        $this->uri = $uri;
        $this->pdo = new PdoCrud($pdo);
    }

    /**
     *
     * @throws JsonException
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
       , IF(u.is_active = true, 'Active', 'Inactive') AS is_active
       , IF(u.is_email_verified = true, 'Yes', 'No') AS is_email_verified
FROM
users AS u
INNER JOIN roles AS r ON u.role_id = r.role_id";

        $results = $this->pdo->pdoQuery($sql);
        $results = $results->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($results, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }
}
