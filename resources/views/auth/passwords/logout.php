<?php

use App\Validation\FormValidation;
use PerfectApp\Utilities\Flash;

require '../resources/views/partials/header.php';
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);
FLASH::displayMessages();
require '../resources/views/partials/footer.php';
