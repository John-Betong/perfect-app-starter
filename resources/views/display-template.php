<?php declare(strict_types=1);

//TODO: Used by register controller. Why do I have this instead of using layout?
// This should be in layouts folder

use App\Validation\FormValidation;
$validate = new FormValidation();

require 'partials/header.php';
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);

if (!empty($errorResult))
{
    $validate->setError($error);
    echo $validate->displayErrors();
}

require '../resources/views/' . $templatePage . '.php';
require 'partials/footer.php';
