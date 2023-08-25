<?php

return [
    'doctrine' => [
        'connection' => [
            // local connection
            'orm_default' => [
                'params' => [
                    'driverClass' => \Doctrine\DBAL\Driver\PDO\MySql\Driver::class,
                    'host' => 'neutrino_mysql',
                    'port' => '3306',
                    'user' => 'admin',
                    'password' => '1',
                    'dbname' => 'neutrino',
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8',
                    ],
                ],
            ],
        ],
    ],
];