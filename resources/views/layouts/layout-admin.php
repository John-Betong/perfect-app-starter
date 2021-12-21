<?php declare(strict_types=1);

use PerfectApp\Utilities\Flash;

//----------------------------------------------------------------------------------------
// Redirect if not logged in
//----------------------------------------------------------------------------------------

if (!isset($_SESSION['login']))
{
    redirect('login');
}

// Make sure user exists in DB for Session. Admin may have deleted user.
isValidUser();

require '../resources/views/partials/header-admin.php';
require '../resources/views/partials/navbar.php';
?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php //require 'partials/menu.php';?>
        </div>
        <div class="col-md-12">
            <?php
            FLASH::displayMessages();
            require '../resources/views/' . $templatePage . '.php';
            ?>
        </div>
    </div>
    </div>
<?php
require '../resources/views/partials/footer.php';
