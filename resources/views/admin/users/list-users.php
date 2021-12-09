<?php declare(strict_types=1);

use PerfectApp\Html\HtmlTable;
use PerfectApp\Utilities\Flash;

//----------------------------------------------------------------------------------------
// Displays flash message for record insert, edit, delete
//----------------------------------------------------------------------------------------

FLASH::displayMessages();

//----------------------------------------------------------------------------------------
// Show Debug Parameters
//----------------------------------------------------------------------------------------

if (SHOW_DEBUG_PARAMS)
{
    show_debug_params($stmt);
}

//----------------------------------------------------------------------------------------
// Show Page Title & Add Record Button
//----------------------------------------------------------------------------------------

add_record_button('List Users', 'add-user', 'User');

if (!$result)
{
    echo '<H1 class="text-center">No Records Available</H1>';
}

// ---------------------------------------------------------------------------------------
// Table Header
// ---------------------------------------------------------------------------------------

else
{
    $tbl = new HtmlTable('myDataTable', 'table table-bordered table-striped table-hover table-sm');
    $tbl->addTSection('thead', 'thead-dark');
    $tbl->addRow();
    $tbl->addCell('User ID', '', 'header');
    $tbl->addCell('Role', '', 'header');
    $tbl->addCell('Username', '', 'header');
    $tbl->addCell('Email', '', 'header');
    $tbl->addCell('First Name', '', 'header');
    $tbl->addCell('Last Name', '', 'header');
    $tbl->addCell('Is Active', '', 'header');
    $tbl->addCell('Is Email Verified', '', 'header');
    $tbl->addCell('Last login', '', 'header');
    $tbl->addCell('Edit', '', 'header');
    $tbl->addCell('Delete', '', 'header');

// ---------------------------------------------------------------------------------------
// Table Body
// ---------------------------------------------------------------------------------------

    $tbl->addTSection('body', 'searchable');

    foreach ($result as $row)
    {
        $tbl->addRow();
        $tbl->addCell((string)$row['user_id']);
        $tbl->addCell(html_escape($row['role_description']));
        $tbl->addCell(html_escape($row['username']));
        $tbl->addCell(html_escape($row['email']));
        $tbl->addCell(html_escape($row['first_name']));
        $tbl->addCell(html_escape($row['last_name']));
        $tbl->addCell(html_escape($row['is_active']));
        $tbl->addCell(html_escape($row['is_email_verified']));
        $tbl->addCell(html_escape($row['last_login']));
        $tbl->addCell("<a href='./edit-user?id={$row['user_id']}' class='btn btn-warning btn-sm'>&#9998; Edit</a>");
        $lockButton = $row['user_id'] === $_SESSION['user_id'] ? '&#128274;' : "<a href='./delete-user?id={$row['user_id']}' class='btn btn-danger btn-sm'>&#128465; Delete</a>";
        $tbl->addCell($lockButton);
    }
    echo $tbl->display();
}
