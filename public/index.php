<?php declare(strict_types=1);

require '../vendor/autoload.php';
require '../app/Core/bootstrap.php';

use App\Core\Request;
use App\Core\Router;

$request = new Request;
$router = new Router($pdo, $request->uri());
require BASEDIR . '/config/routes.php';
$router->directTraffic($request->method());
