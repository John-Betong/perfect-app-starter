<?php
declare(strict_types=1);

// Helped from https://github.com/davidecesarano/Validation/blob/master/Validation.php

namespace App\Validation;


/**
 * Class FormValidation
 * @package App\Validation
 */
class FormValidation
{
    /**
     * @var array
     */
    public array $error = [];


    /**
     * @param array $whitelist
     * @param array $postArray
     */
    final public function validateWhiteList(array $whitelist, array $postArray): void
    {
        foreach ($postArray as $key => $val)
        {
            if (!in_array($key, $whitelist, true))
            {
                die('Hack-Attempt Detected. Please use only the fields in the form');
            }
        }
    }


    /**
     * @param array $requiredFields
     * @param array $requestArray  $_POST, $_GET
     * @return array
     */
    final public function requiredFieldCheck(array $requiredFields, array $requestArray): array
    {
        foreach ($requiredFields as $val) {
            if (empty($requestArray[$val])) {
                $msg = ucwords(str_replace('_', ' ', $val));
                $this->error[$val] = $msg . ' Required';
            }
        }
        return $this->error;
    }


    /**
     * @return array
     */
    final public function validateEmail(): array
    {
        if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = 'Enter A Valid Email';
        }
        return $this->error;
    }


    /**
     * @return array
     */
    final public function validatePasswordConfirm(): array
    {
        if (!empty($_POST['password']) && !empty($_POST['password_confirm']) && $_POST['password'] !== $_POST['password_confirm']) {
            $this->error['password_confirm'] = 'Passwords Do Not Match.';
        }
        return $this->error;
    }


    /**
     * @param $requestType
     * @param $field
     * @return array //reset_code, k
     */
    final public function validateResetCode(array $requestType, string $field): array
    {
        if (strlen($requestType[$field]) !== 32 || (!ctype_xdigit($requestType[$field])))
        {
            $this->error['invalid_key'] = 'Valid Activation Code Required';
        }
        return $this->error;
    }

    /**
     * @param array $error
     */
    final public function setError(array $error): void
    {
        $this->error = $error;
    }


    /**
     * @return array
     */
    final public function getErrors(): array
    {
        return $this->error;
    }


    /**
     * @return string $html
     */
    final public function displayErrors(): string
    {
        $html = '<div class="col-md-6 offset-md-3">';
        $html .= '<div class="danger">';
        foreach ($this->error as $error) {
            $html .= $error . "<br>\n";
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
