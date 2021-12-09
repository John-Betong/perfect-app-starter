<?php

use PerfectApp\Html\HtmlTable;

// ---------------------------------------------------------------------------------------
// Table Header
// ---------------------------------------------------------------------------------------

$tbl = new HtmlTable('myDataTable',
    'table table-bordered table-striped table-hover table-sm');
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

$status = 1 === 0 ? 'danger' : 'success';
$message = 1 === 0 ? 'Failed' : 'Success';

$tbl->addRow();
$tbl->addCell('myusername');
$tbl->addCell('127.0.0.1');
$tbl->addCell("<span class='badge badge-$status'>$message</span>");
$tbl->addCell('12-08-2021');


$status = 0 === 0 ? 'danger' : 'success';
$message = 0 === 0 ? 'Failed' : 'Success';

$tbl->addRow();
$tbl->addCell('anotherusername');
$tbl->addCell('192.168.1.1');
$tbl->addCell("<span class='badge badge-$status'>$message</span>");
$tbl->addCell('12-06-2021');



echo $tbl->display();