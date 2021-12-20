<h1>SETTINGS</h1>
<p>
    <span class="badge-pill badge-<?= LOG_ERROR === 0 ? 'danger' : 'success' ?> "><?= LOG_ERROR === 0 ? 'Off' : 'On' ?></span>
    Error Logging </p>
<p>
    <span class="badge-pill badge-<?= DEBUG === 0 ? 'danger' : 'success' ?> "><?= DEBUG === 0 ? 'Off' : 'On' ?></span>
    Debugging </p>
<p>
    <span class="badge-pill badge-<?= EMAIL_ERROR === 0 ? 'danger' : 'success' ?> "><?= EMAIL_ERROR === 0 ? 'Off' : 'On' ?></span>
    Email Admin errors</p>
<p><span class="badge-pill badge-info"><?= date_default_timezone_get() ?></span> Time Zone</p>
<br>
<table class="table table-bordered table-striped table-hover">
    <thead class="thead-dark">
    <tr>
        <th colspan="2">Global Site Settings</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Time Zone</td>
        <td><?= date_default_timezone_get() ?></td>
    </tr>
    <tr>
        <td>Admin Email</td>
        <td><?= ADMIN_EMAIL_FROM ?></td>
    </tr>
    <tr>
        <td>Max. Upload Filesize</td>
        <td><?= ini_get('upload_max_filesize') ?></td>
    </tr>
    </tbody>
</table>
<div>
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th colspan="2">Application Paths</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Application Url</td>
            <td><?= APPLICATION_URL ?></td>
        </tr>
        <tr>
            <td>Absolute Path</td>
            <td><?= BASEDIR ?></td>
        </tr>
        <tr>
            <td>Error Log Path</td>
            <td><?= ERROR_LOG_PATH ?></td>
        </tr>
        <tr>
            <td>Error Log Status</td>
            <td><?= check_error_log() ?></td>
        </tr>
        </tbody>
    </table>
</div>
