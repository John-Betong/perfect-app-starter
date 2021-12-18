<?php declare(strict_types=1);

use PerfectApp\Database\Connection;

session_start();

require 'functions.php';
require dirname(__DIR__, 2) . '/config/config.php';
$config = require  BASEDIR . '/config/dbConfig.php';
$pdo = (new Connection())->connect($config);
