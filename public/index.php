<?php declare(strict_types=1);

require '../vendor/autoload.php';
require '../app/Core/bootstrap.php';

use App\Core\Request;
use App\Core\Router;

$request = new Request;
$router = new Router($request->uri());
require '../app/routes.php';
$router->directTraffic($request->method());