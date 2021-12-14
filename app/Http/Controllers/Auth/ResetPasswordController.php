<?php declare(strict_types=1);


namespace App\Http\Controllers\Auth;

use App\Validation\FormValidation;
use PDO;
use PerfectApp\Database\PdoCrud;
use PerfectApp\Mail\PHPMailSubmissionAgent;
use PerfectApp\Utilities\Flash;


/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Auth
 */
class ResetPasswordController
{
    /**
     * @var PHPMailSubmissionAgent
     */
    protected PHPMailSubmissionAgent $mailSubmissionAgent;

    /**
     * @var PdoCrud
     */
    private PdoCrud $pdoCrud;

    /**
     * @var FormValidation
     */
    private FormValidation $validate;

    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @var string[]
     */
    private array $allowedFields = [
          'reset_code'
        , 'new_password'
        , 'confirm_new_password'
    ];

    /**
     * @var string[]
     */
    private array $requiredFields = [
          'reset_code'
        , 'new_password'
        , 'confirm_new_password'
    ];

    /**
     * @var string
     */
    private string $templatePath = 'auth/passwords/form-reset';

    /**
     * @var mixed|null
     */
    private $reset_code;

    /**
     * ResetPasswordController constructor.
     *
     * @param  PDO  $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->mailSubmissionAgent = new PHPMailSubmissionAgent();
        $this->validate = new FormValidation();
        $this->pdoCrud = new PdoCrud($pdo);
        $this->reset_code = $_POST['reset_code'] ?? $_GET['k'] ?? null;
    }

    /**
     * * Show the form for creating a new resource.
     *
     */
    final public function create(): void
    {
        view(
            'display-template',
            [
                  'templatePage' => $this->templatePath
                , 'reset_code' => $this->reset_code
            ]
        );
    }

    /**
     *
     */
    final public function update(): void
    {
        //------------------------------------------------------------------------
        // Trim Data
        //------------------------------------------------------------------------

        $_POST = trim_array($_POST);

        //------------------------------------------------------------------------------------
        // Whitelist Form Fields
        //------------------------------------------------------------------------------------

        $this->validate->validateWhiteList($this->allowedFields, $_POST);

        //------------------------------------------------------------------------------------
        // Check Required Fields
        //------------------------------------------------------------------------------------

        $this->validate->requiredFieldCheck($this->requiredFields, $_POST);

        //------------------------------------------------------------------------------------
        // Validate Fields
        //------------------------------------------------------------------------------------

        $this->validate->validatePasswordConfirm();
        $this->validate->validateResetCode($_POST, 'reset_code');
        $error = $this->validate->getErrors();

        //------------------------------------------------------------------------
        // Check for errors
        //------------------------------------------------------------------------

        if ($error)
        {
            $errorResult = $this->validate->displayErrors();
            view(
                'display-template',
                [
                    'templatePage' => $this->templatePath,
                    'error' => $error,
                    'errorResult' => $errorResult ?? '',
                    'reset_code' => $this->reset_code
                ]
            );
            die;
        }

        // Decode & Hash raw token
        $token_hash = hash('sha256', hex2bin($_POST['reset_code']));

        // Check DB for matching reset key.
        $sql = 'SELECT user_id, email, password_reset_hash FROM users WHERE password_reset_hash=? AND password_reset_expires > NOW()';
        $row = $this->pdoCrud->prepareExecuteQuery($sql, [$token_hash])->fetch();

        //--------------------------------------------------------------------------------
        // No Results - Redirect
        //--------------------------------------------------------------------------------

        if (!$row)
        {
            Flash::addmessage(ACTIONS_ARRAY['failed_confirmation']['message'], ACTIONS_ARRAY['failed_confirmation']['status']);
            redirect('login');
        }

        //--------------------------------------------------------------------------------
        // Update Password
        //--------------------------------------------------------------------------------

        $status = 'failed_reset';

        $hashed_new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $sql = 'UPDATE users SET password = ?, password_reset_hash = ?, password_reset_expires = ? WHERE user_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$hashed_new_password, null, null, $row['user_id']]);

        if ($stmt->rowCount())
        {
            $status = 'reset';

            //--------------------------------------------------------------------------------
            // Send Reset Email
            //--------------------------------------------------------------------------------

            $to = $row['email'];
            $subject = 'Password has been reset';

            $message = '<html lang="en"><body>';
            $message .= '<p style="color:#080;font-size:18px;">Password has been reset</p>';
            $message .= '</body></html>';

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            $headers[] = "To: $to <$to>";
            $headers[] = 'From:' . ADMIN_EMAIL_FROM;

            $this->mailSubmissionAgent->send($to, $subject, $message, $headers);
        }

        Flash::addmessage(ACTIONS_ARRAY[$status]['message'], ACTIONS_ARRAY[$status]['status']);
        redirect('login');
    }
}
