<?php

use Ramsey\Uuid\Doctrine\UuidType;

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'types' => [
                    UuidType::NAME => UuidType::class,
                ],
            ]
        ],
        'connection' => [
            'orm_default' => [
                'eventmanager'  => 'orm_default',
                'configuration' => 'orm_default',
                'params' => [
                    'driverClass' => \Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'username',
                    'password' => 'password',
                    'dbname'   => 'database',
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8',
                    ],
                ],
            ],
        ],
        'driver' => [

        ],
        'authentication' => [
            'orm_default' => [
                'object_manager' => \Doctrine\ORM\EntityManager::class,
                'identity_class' => \Application\Entity\User::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => \Application\Cryptography\VerifyPassword::class,
            ],
        ],
        'entitymanager' => [
            'orm_default' => [
                'connection'    => 'orm_default',
                'configuration' => 'orm_default',
            ],
        ],
        'eventmanager' => [
            'orm_default' => [],
        ],

        'sql_logger_collector' => [
            'orm_default' => [],
        ],

        'entity_resolver' => [
            'orm_default' => [],
        ],
        // Doctrine Migrations
        'migrations_configuration' => [
            'orm_default' => [
                'table_storage' => [
                    'table_name' => 'doctrine_migration_versions',
                    'version_column_name' => 'version',
                    'version_column_length' => 1024,
                    'executed_at_column_name' => 'executed_at',
                    'execution_time_column_name' => 'execution_time',
                ],
                'migrations_paths' => [], // an array of namespace => path
                'migrations' => [], // an array of fully qualified migrations
                'all_or_nothing' => false,
                'check_database_platform' => true,
                'organize_migrations' => 'year', // year or year_and_month
                'custom_template' => null,

                /*
                * 'directory' => 'data/DoctrineORMModule/Migrations',
                * 'name'      => 'Doctrine Database Migrations',
                * 'table'     => 'migrations',
                */
            ],
        ],
    ],
];
