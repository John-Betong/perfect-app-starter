<?php declare(strict_types=1);

use PerfectApp\Html\HtmlTable;

$row = $stmt->fetch();

//----------------------------------------------------------------------------------------
// Show Debug Parameters
//----------------------------------------------------------------------------------------

if (SHOW_DEBUG_PARAMS)
{
    show_debug_params($stmt);
}

echo '<h5>Login Attempts</h5>';

if (!$row)
{
    echo '<H1 class="text-center">No Records Available</H1>';
}

else
{
    ?>
    <div class="row justify-content-md-center">

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-star fa-5x"></i>
                </div>
                <div class="mr-5"><?= $row['success'] ?> Successful Logins</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-exclamation-triangle fa-5x"></i>
                </div>
                <div class="mr-5"><?= $row['fail'] ?> Failed Logins</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

</div>
<?php

// ---------------------------------------------------------------------------------------
// Table Header
// ---------------------------------------------------------------------------------------

    $tbl = new HtmlTable('myDataTable', 'table table-bordered table-striped table-hover table-sm');
    $tbl->addTSection('thead', 'thead-dark');
    $tbl->addRow();
    $tbl->addCell('Username', '', 'header');
    $tbl->addCell('IP', '', 'header');
    $tbl->addCell('Login Status', '', 'header');
    $tbl->addCell('Date', '', 'header');

// ---------------------------------------------------------------------------------------
// Table Body
// ---------------------------------------------------------------------------------------

    $tbl->addTSection('body', 'searchable');
    do
    {
        $status = $row['login_status'] === 0 ? 'danger' : 'success';
        $message = $row['login_status'] === 0 ? 'Failed' : 'Success';

        $tbl->addRow();
        $tbl->addCell(html_escape($row['login_username']));
        $tbl->addCell($row['login_ip_inet_ntoa']);
        $tbl->addCell("<span class='badge badge-$status'>$message</span>");
        $tbl->addCell($row['login_datetime']);
    } while ($row = $stmt->fetch());

    echo $tbl->display();
}
