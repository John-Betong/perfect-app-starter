<?php declare(strict_types=1);

//----------------------------------------------------------------------------------------
// Database Config
//----------------------------------------------------------------------------------------

return [
    'dev-mysql' => [
          'host' => 'localhost'
        , 'dbname' => 'perfect-app-starter'
        , 'username' => 'root'
        , 'password' => ''
        , 'port' => '3306'
        , 'charset' => 'utf8mb4'
        , 'options' => [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            , PDO::ATTR_EMULATE_PREPARES => false
              ]

    ],
    'prod-mysql' => [
          'host' => 'example.com'
        , 'dbname' => 'example'
        , 'username' => 'root'
        , 'password' => ''
        , 'port' => '3306'
        , 'charset' => 'utf8mb4'
        , 'options' => [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            , PDO::ATTR_EMULATE_PREPARES => false
              ]
    ]
];
