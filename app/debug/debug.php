<?php declare(strict_types=1);

namespace PerfectApp\Debug;

if (DEBUG)
{
    $session = $_SESSION ?? '$_SESSION is not set';
    $var = [
        'POST' => [SHOW_POST_DATA => $_POST]
        , 'GET' => [SHOW_GET_DATA => $_GET]
        , 'COOKIE' => [SHOW_COOKIE_DATA => $_COOKIE]
        , 'REQUEST' => [SHOW_REQUEST_DATA => $_REQUEST]
        , 'SESSION' => [SHOW_SESSION_DATA => $session]];

    ob_start();
    $varDumper = new HTMLVarDumper();
    ShowDebugData::displayDebugData($varDumper, $var);
}
