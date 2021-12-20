<?php declare(strict_types=1);

/**
 * @param array $data
 */
function pr(array $data): void
{
    echo '<pre>', print_r($data, true), '</pre>';
}

/**
 * @param $data
 */
function dd($data): void
{
    dump($data);
    die;
}

/**
 * @param mixed ...$data
 */
function dump(...$data): void
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
function view(string $pageName, array $templateData = []): void
{
    extract($templateData, EXTR_OVERWRITE);
    require "../resources/views/$pageName.php";
}

/**
 * Displays SQL Query & Parameters
 *
 * @param $stmt
 */
function show_debug_params(object $stmt): void
{
    echo '<div class="info">';
    echo $stmt->debugDumpParams();
    echo '</div>';
}

/**
 * Force logout if logged in user has been deleted from DB
 * Called in layout-admin.php
 */
function isValidUser(): void
{
    global $pdo;// TODO: Get rid of global. Just a quickfix to test function
    $sql = "SELECT EXISTS(SELECT * FROM users WHERE user_id = ?) as isvalid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $row = $stmt->fetch();

    if ($row['isvalid'] === 0)
    {
        redirect('login');
    }
}

/**
 * Validates User Supplied - Url Manipulation Protection
 *
 * Checks whether user supplied primary key (from URL) matches with paired user Id in Database.
 *
 * @param PDO $pdo
 * @param string $primaryKey
 * @param string $id
 * @param string $table
 * @param int $userId
 */
function isValidId(PDO $pdo, string $primaryKey, string $id, string $table, $userId): void
{
    $sql = "SELECT EXISTS(SELECT * FROM $table WHERE $primaryKey = ? AND owned_by = ?) as isvalid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id, $userId]);
    $row = $stmt->fetch();

    if ($row['isvalid'] === 0)
    {
        throw new InvalidArgumentException('Invalid Id - You cannot Edit a record you do not own.');
    }
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
 * Display Add Record Button
 *
 * @param string $action_title
 * @param string $url
 * @param string $button_text
 */
function add_record_button(string $action_title, string $url, string $button_text): void
{
    ?>
    <p style="font-size:21px"><?= ucwords($action_title) ?></p>
    <p>
        <a href="<?= $url ?>" class="btn btn-primary" role="button">&#10133; Add <?= ucwords($button_text) ?></a>
    </p>
    <?php
}

/**
 * @param string $table_name
 * @param int $id
 */
function edit_link(string $table_name, int $id): void
{
    ?>
    <td>
        <a href="/edit-<?= $table_name ?>?id=<?= $id ?>"
           class="btn btn-warning btn-sm" role="button">Edit</a>
    </td>
    <?php
}

/**
 * @param string $table_name
 * @param int $id
 */
function delete_link(string $table_name, int $id): void
{
    ?>
    <td>
        <a href='/delete-<?= $table_name ?>?id=<?= $id ?>'
           class='btn btn-danger btn-sm' role='button'>Delete</a>
    </td>
    <?php
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
	header('HTTP/1.1 500 Internal Server Error', TRUE, 500);
    require BASEDIR . '/resources/views/partials/header.php';
    echo '<div class="danger col-md-12"><b>500 Internal Server Error</b>';

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
    require BASEDIR . '/resources/views/partials/footer.php';
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
