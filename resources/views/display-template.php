<?php declare(strict_types=1);

//----------------------------------------------------------------------------------------
// Redirect if logged in
//----------------------------------------------------------------------------------------

if (isset($_SESSION['login']))
{
    redirect('dashboard');
}

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
