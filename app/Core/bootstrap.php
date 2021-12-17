<?php declare(strict_types=1);

use App\Core\Database\Connection;

session_start();

require 'functions.php';
require '../config.php';
$config = require '../config/dbConfig.php';
$pdo = (new Connection())->connect($config);
