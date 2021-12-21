<?php declare(strict_types=1);

use PerfectApp\Utilities\Flash;

require '../resources/views/partials/header.php';
?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
            Flash::displayMessages();
            require '../resources/views/' . $templatePage . '.php';
            ?>
        </div>
    </div>
    </div>
<?php
require '../resources/views/partials/footer.php';
