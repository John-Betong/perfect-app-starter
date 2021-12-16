<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use PDOException;

/**
 * Class RegisterControllerRegister
 * @package App\Controllers
 */
class RegisterController extends RegisterBaseController
{
    /**
     * * Show the form for creating a new resource.
     *
     */
    final public function create(): void
    {
        view('display-template', ['templatePage' => $this->templatePath, 'errorResult' => '']);
    }

    /**
     *
     */
    final public function store(): void
    {
        $error = $this->preChecks();

        if (!$error)
        {
            [$encoded_token, $token_hash] = $this->tokenGenerator->generateToken();
            unset($_POST['password_confirm']);
            $_POST['verify_email_hash'] = $token_hash;
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            try
            {
                $this->db->insert('users', $_POST);
            }
            catch (PDOException $e)
            {
                if ($e->getCode() === '23000')
                {
                    $error[] = 'Registration Failed<br>Invalid Username or Email';
                    $this->validate->setError($error);
                    $errorResult = $this->validate->displayErrors();

                    view(
                        'display-template',
                        [
                            'templatePage' => $this->templatePath,
                            'errorResult' => $errorResult,
                            'error' => $error,
                        ]
                    );
                    die;
                }
                throw $e;
            }
            $this->emailActivationToken($encoded_token);
        }

        if ($error)
        {
            $errorResult = $this->validate->displayErrors();

            view(
                'display-template',
                [
                    'templatePage' => $this->templatePath,
                    'errorResult' => $errorResult,
                    'error' => $error,
                ]
            );
        }
    }

    /**
     * @param $encoded_token
     */
    private function emailActivationToken(string $encoded_token): void
    {
        /*Send user activation email*/
        //$message = "Click to activate account\r\n" . APPLICATION_URL . "/activate?k=$encoded_token";


        $to = $_POST['email'];
        $subject = APP_NAME . ' - Verify Email';

                $message = '<html lang="en"><body>';
                $message .= '<h1 style="color:#f40;">Thank you for registering.</h1>';
                $message .= '<p style="color:#080;font-size:18px;">Click the link below to activate your account.</p>';
                $message .= "<p style='color:#080;font-size:18px;'><a href='". APPLICATION_URL . "/activate?k=$encoded_token'>" . APPLICATION_URL . "/activate?k=$encoded_token</a></p>";
                $message .= '</body></html>';

                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                $headers[] = 'From:' . ADMIN_EMAIL_FROM;

        $this->mailSubmissionAgent->send($to, $subject, $message, $headers);
        redirect('./login?action=confirm');
    }
}
