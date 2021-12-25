<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use PerfectApp\Database\PdoCrud;
use DateInterval;
use DateTime;
use Exception;
use PDO;
use App\Validation\FormValidation;
use PerfectApp\Mail\PHPMailSubmissionAgent;
use PerfectApp\Utilities\Flash;
use PerfectApp\Utilities\TokenGenerator;

/**
 * Class ForgotPasswordController
 *
 * @package App\Controllers
 */
class ForgotPasswordController
{
    /**
     * @var PdoCrud
     */
    private PdoCrud $pdoCrud;

    /**
     * @var FormValidation
     */
    private FormValidation $validate;

    /**
     * @var string
     */
    private string $templatePath = 'auth/passwords/form-forgot-password';

    /**
     * @var PHPMailSubmissionAgent
     */

    private PHPMailSubmissionAgent $mailSubmissionAgent;

    /**
     * @var TokenGenerator
     */
    private TokenGenerator $tokenGenerator;

    /**
     * @var array
     */
    private array $allowedFields = ['email'];

    /**
     * @var array
     */
    private array $requiredFields = ['email'];

    /**
     * ForgotPasswordController constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->mailSubmissionAgent = new PHPMailSubmissionAgent();
        $this->validate = new FormValidation();
        $this->pdoCrud = new PdoCrud($pdo);
        $this->tokenGenerator = new TokenGenerator();
    }

    /**
     * * Show the form for creating a new resource.
     *
     */
    final public function create(): void
    {
        view('display-template', ['templatePage' => $this->templatePath]);
    }

    /**
     * @throws Exception
     */
    final public function update(): void
    {
        $_POST = trim_array($_POST);
        $this->validate->validateWhiteList($this->allowedFields, $_POST);
        $this->validate->requiredFieldCheck($this->requiredFields, $_POST);
        $this->validate->validateEmail();
        $error = $this->validate->getErrors();

        if ($error) {
            $errorResult = $this->validate->displayErrors();
            view(
                'display-template', [
                    'templatePage' => $this->templatePath,
                    'errorResult' => $errorResult,
                    'error' => $error,
                ]
            );
            die;
        }

        $sql = 'SELECT email FROM users WHERE email = ?';
        $row = $this->pdoCrud->prepareExecuteQuery($sql, [$_POST['email']])->fetch();

        //--------------------------------------------------------------------------------
        // No Results - Redirect, show user reset message even though email invalid
        //--------------------------------------------------------------------------------

        if (!$row)
        {
            Flash::addmessage(ACTIONS_ARRAY['reset_sent']['message'], ACTIONS_ARRAY['reset_sent']['status']);
            redirect('login');
        }

        //--------------------------------------------------------------------------------
        //
        //--------------------------------------------------------------------------------

        [$encoded_token, $token_hash] = $this->tokenGenerator->generateToken();

        /**
         * Interval specification.
         *
         * The format starts with the letter P, for "period." Each duration period is
         * represented by an integer value followed by a period designator. If the
         * duration contains time elements, that portion of the specification is
         * preceded by the letter T.
         *
         * @link http://www.php.net/manual/en/dateinterval.construct.php
         *
         * String to time option
         * $password_reset_expiration_datetime = date('Y-m-d H:i:s', strtotime("+5 min"));
         *
         */
        $period_designator = 'PT';
        $timespan = 'M'; //Minutes
        $timespan_add = 5; // Amount of days or minutes

        $time = new DateTime(date('Y-m-d H:i:s'));
        $time->add(new DateInterval($period_designator . $timespan_add . $timespan));

        $password_reset_expires = $time->format('Y-m-d H:i:s');

        $this->pdoCrud->update(
            'users', 'email', [
                  'password_reset_hash' => $token_hash
                , 'password_reset_expires' => $password_reset_expires
                , 'id' => $_POST['email']
            ]
        );

        //--------------------------------------------------------------------------------
        // Email Reset Data
        //--------------------------------------------------------------------------------

        $to = $row['email'];
        $subject = APP_NAME . ' - Forgot Password';

        $message = '<html lang="en"><body>';
        $message .= '<h1 style="color:#f40;">We received a password reset request. If you did not request to reset your password just ignore this message.</h1>';
        $message .= '<p style="color:#080;font-size:18px;">Click the link below to set reset password.</p>';
        $message .= "<p style='color:#080;font-size:18px;'><a href='". APPLICATION_URL . "/reset?k=$encoded_token'>" . APPLICATION_URL . "/reset?k=$encoded_token</a></p>";
        $message .= '</body></html>';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From:' . ADMIN_EMAIL_FROM;

        $this->mailSubmissionAgent->send($to, $subject, $message, $headers);
        Flash::addmessage(ACTIONS_ARRAY['reset_sent']['message'], ACTIONS_ARRAY['reset_sent']['status']);
        redirect('login');
    }
}
