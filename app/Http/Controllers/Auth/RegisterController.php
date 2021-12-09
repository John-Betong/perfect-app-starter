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
            echo '<a href="/">Back</a><br>';
            echo "TODO - Enable Code";
            pr($_POST);
/*            [$encoded_token, $token_hash] = $this->tokenGenerator->generateToken();
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
            $this->emailActivationToken($encoded_token);*/
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
        $message = "Click to activate account\r\n" . APPLICATION_URL . "/activate?k=$encoded_token";
        $this->mailSubmissionAgent->send(ADMIN_EMAIL_TO, 'Confirm Email', $message, ADMIN_EMAIL_FROM);
        redirect('./login?action=confirm');
    }
}
