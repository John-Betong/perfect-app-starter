<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Validation\FormValidation;
use PDO;
use PerfectApp\Utilities\Flash;

/**
 * Class ActivationController
 * @package App\Http\Controllers\Auth
 */
class ActivationController
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * ActivationController constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     */
    final public function activate(): void
    {
        if (!isset($_GET['k']))
        {
            redirect('./');
        }

//------------------------------------------------------------------------------------
// Validate Fields
//------------------------------------------------------------------------------------

        $validate = new FormValidation();
        $validate->validateResetCode($_GET, 'k');
        $error = $validate->getErrors();

        if ($error)
        {
            echo $validate->displayErrors();
        }
        else
        {
            // Decode & Hash raw token
            $token_hash = hash('sha256', hex2bin($_GET['k']));

            $sql = 'UPDATE users SET is_active=?, is_email_verified=?, verify_email_hash=? WHERE verify_email_hash = ? ';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([1, 1, null, $token_hash]);

            $status = $stmt->rowCount() ? 'verified' : 'failed_confirmation';
            Flash::addmessage(ACTIONS_ARRAY[$status]['message'], ACTIONS_ARRAY[$status]['status']);
            redirect("./login");
        }
    }
}
