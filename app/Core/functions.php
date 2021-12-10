<?php declare(strict_types=1);

/**
 * @param array $data
 */
function pr(array $data)
{
    echo '<pre>', print_r($data, true), '</pre>';
}

/**
 * @param $data
 */
function dd($data)
{
    dump($data);
    die;
}

/**
 * @param mixed ...$data
 */
function dump(...$data)
{
    var_dump(...$data);
}

/**
 * @param string $path
 */
function redirect(string $path): void
{
    header("Location: /$path");
    die;
}

/**
 * @param string $pageName
 * @param array $templateData
 */
function view(string $pageName, array $templateData = [])
{
    extract($templateData, EXTR_OVERWRITE);
    require BASEDIR . "/resources/views/$pageName.php";
}

/**
 * Check error log file exists/writable
 */
function check_error_log(): string
{
    if (is_writable(ERROR_LOG_PATH))
    {
        return "<div class='success'>The error log file exists and is writeable<br>" . ERROR_LOG_PATH . " </div>\n";
    }
    return "<div class='danger'>The error log file does not exist or is not writable<br>" . ERROR_LOG_PATH . "</div>\n";
}

/**
 * @param array $errorArr
 * @return string
 */
function show_form_errors(array $errorArr): string
{
    $errors = implode("<br>\n", $errorArr) . "\n";

    return <<<EOD
<div class="col-md-6 offset-md-3">
        <div class="danger">$errors</div>
    </div>
EOD;

}

/**
 * Displays logo
 *
 * @param int $img_width Image width
 * @param int $img_height Image height
 * @param string $alt_text Image Alt text
 */

function logo(int $img_width, int $img_height, string $alt_text): void
{
    ?>
    <div class="d-flex p-2 justify-content-center mb-5">
        <a href="<?= APPLICATION_URL ?>">
            <img src="./images/<?= IMAGE_FILENAME ?>"
                 width="<?= $img_width ?>"
                 height="<?= $img_height ?>"
                 alt="<?= $alt_text ?>">
        </a>
    </div>
    <?php
}

/**
 * @param string $unsafe_data
 * @return string
 */
function html_escape(string &$unsafe_data): string
{
    return $unsafe_data = htmlspecialchars($unsafe_data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}

/**
 * Custom Exception Handler
 *
 * @param object $exception Error data
 */

function custom_exception(object $exception): void
{
    require BASEDIR . '/resources/views/partials/header.php';
    echo '<div class="danger col-md-12"><b>Fatal Error!</b>';

    $error_msg = 'DATE: ' . MYSQL_DATETIME_TODAY . "\nERROR: " . $exception->getMessage() . "\nFILE: " . $exception->getFile() . ' on line ' . $exception->getLine() . "\n\nSTACK TRACE\n" . $exception->getTraceAsString() . "\n";

    if (EMAIL_ERROR)
    {
        echo '<br>Admin has been notified';
        error_log($error_msg, 1, ADMIN_EMAIL_TO, 'From:' . ADMIN_EMAIL_FROM);
    }
    else
    {
        echo '<br>Admin has not been notified';
    }

    // Write error to log
    if (LOG_ERROR)
    {
        echo '<br>Error has been logged';
        error_log("$error_msg\r\n", 3, ERROR_LOG_PATH);
    }
    else
    {
        echo '<br>Error has not been logged';
    }

    echo '</div>';

    if (DEBUG)
    {
        echo '<div class="danger col-md-12"><b>Error Message:</b>';
        echo '<pre>';
        echo '<br>Exception Code: ' . $exception->getCode() . '<br>';
        echo $exception->getMessage();
        echo '<br>FILE: ' . $exception->getFile();
        echo '<br>on line ' . $exception->getLine();
        echo '</pre>';
        echo '</div>';

        echo '<div class="danger"><b>Stack Trace:</b><br>';
        echo '<pre>';
        echo $exception->getTraceAsString();
        echo '</pre>';
        echo '</div>';
    }
    require BASEDIR . './resources/views/partials/footer.php';
}

/**
 * @param $input
 * @return array|string
 */
function trim_array($input)
{
    if (!is_array($input))
    {
        return trim($input);
    }
    return array_map('trim_array', $input);
}
