<?php declare(strict_types=1);

require '../vendor/autoload.php';
require '../app/Core/bootstrap.php';

use App\Core\Request;
use App\Core\Router;


use PerfectApp\Config\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

echo getenv('APP_ENV');
// dev
echo getenv('DATABASE_DNS');

echo getenv('DATABASE_USER');

echo getenv('database_user');

die;
$request = new Request;
$router = new Router($pdo, $request->uri());
require '../app/routes.php';
$router->directTraffic($request->method());
