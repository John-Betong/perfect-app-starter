<?php declare(strict_types=1);

//----------------------------------------------------------------------------------------
// Clear Error Log File
//----------------------------------------------------------------------------------------

$show_how_many_errors = 10;
$error_log_filesize = filesize(ERROR_LOG_PATH);

if (isset($_GET['deleted']) && $error_log_filesize > 0)
{
    $file = fopen(ERROR_LOG_PATH, 'wb');
    fclose($file);
}
?>
<h1>Error Log</h1>

<div class="well">
    <table class="table table-bordered table-striped table-hover">
        <caption></caption>
        <thead class="thead-dark">
        <tr>
            <th>Last <?= $show_how_many_errors ?> Errors - <a href="/errors?deleted"
                                                              title="Delete Errors">Delete Errors</a></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <textarea rows="15" disabled style="width:100%"
                          title="Errors"><?= trim(implode("\n", array_slice(file(ERROR_LOG_PATH), -$show_how_many_errors))) //Show last X line of error log?></textarea>
            </td>
        </tr>
        </tbody>
    </table>
</div>
