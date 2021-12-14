<?php declare(strict_types=1);

//----------------------------------------------------------------------------------------
// Database Config
//----------------------------------------------------------------------------------------

return [
          'charset' =>'utf8mb4'
        , 'dbname' =>'perfect-app-starter'
        , 'username' =>'root'
        , 'password' =>''
        , 'host' => 'localhost'
        //, 'connection'=>'mysql:host=127.0.0.1'
        , 'options'  =>[
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            , PDO::ATTR_EMULATE_PREPARES => false
        ]
];
