<?php

    $id = uniqid();
    $Object = new DateTime();  
    $Object->setTimezone(new DateTimeZone('America/Bogota'));
    $fecha = $Object->format("d-m-Y"); 
    $hora =  $Object->format("H-i-s"); 

    $config = [
        'database' => [
            'enabled' => true,
            'dsn' => 'mysql:host=localhost;dbname=prueba',
            'username' => 'root',
            'password' => '',
            'filename'     => 'mysql'.$fecha.'_'.$hora.'_'.$id.'.sql',
            'target'       => __DIR__.'/backup/mysql',
            'compress'     => 'gzip',
            'remoteFolder' => 'mysql',
        ],
        'local' => [
            'enabled' => true,
            'target'  => __DIR__.'/backup',
        ],
       /* 'archive' => [
            'enabled' => true,
            'target'  => __DIR__.'/backup/archive'.$fecha.'_'.$hora.'_'.$id.'.zip',
        ], */
        'sftp' => [
            'host' => '',
            'port' => 22,
            'username' => '',
            'password' => '',
            'privateKey' => '',
            'root' => '',
            'timeout' => 30000,
        ],
        'ftp' => [
            'enabled'  => false,
            'host'     => '',
            'username' => '',
            'password' => '',
            'port'     => 21,
            'root'     => '/',
            'passive'  => true,
            'ssl'      => false,
            'timeout'  => 30000,
        ],
    ];

    return $config;

