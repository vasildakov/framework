<?php

return [
    'doctrine' => [
        'connection' => [
            // local connection
            'orm_default' => [
                'params' => [
                    'driver' => 'pdo_sqlite',
                    //'driverClass' => \Doctrine\DBAL\Driver\PDO\SQLite\Driver::class,
                    //'host' => 'neutrino_mysql',
                    //'port' => '3306',
                    'path' => __DIR__ . '/data/db.sqlite',
                    //'user' => 'admin',
                    //'password' => '1',
                    //'dbname' => 'framework',
                    //'driverOptions' => [
                    //    1002 => 'SET NAMES utf8',
                    //],
                ],
            ],
        ],
    ],
];