<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use PDO;
use PerfectApp\Database\PdoCrud;

/**
 * Class ListLoginsController
 * @package App\Controllers
 */
class ListLoginsController
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * ListLoginsController constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     */
    final public function index(): void
    {
        $db = new PdoCrud($this->pdo);
        $sql = 'SELECT login_username
     , INET_NTOA( login_ip ) AS login_ip_inet_ntoa
     , login_status
     , login_datetime
     , (SELECT COUNT(*) FROM user_login WHERE login_status = 1) success
	 , (SELECT COUNT(*) FROM user_login WHERE login_status = 0) fail
FROM user_login 
ORDER BY login_datetime DESC';
        $stmt = $db->pdoQuery($sql);
        view('layouts/layout', ['templatePage' => 'admin/users/list-logins', 'stmt' => $stmt]);
    }
}
