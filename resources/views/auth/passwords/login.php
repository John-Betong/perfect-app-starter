<?php

use App\Validation\FormValidation;
use PerfectApp\Utilities\Flash;

$validate = new FormValidation();

require '../resources/views/partials/header.php';
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);
FLASH::displayMessages();

if (!empty($error))
{
    $validate->setError($error);
    echo $validate->displayErrors();
}

require '../resources/views/' . $templatePage . '.php';
require '../resources/views/partials/footer.php';
