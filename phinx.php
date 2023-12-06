<?php

return
    [
        'paths' => [
            'migrations' => './database/migrations',
            'seeds' => './database/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'odin_migration',
            'default_environment' => 'odin',
            'odin' => [
                'adapter' => 'mysql',
                'host' => 'mysql_db',
                'name' => 'odin',
                'user' => 'root',
                'pass' => 'root',
                'port' => 3306,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci'
            ],
        ],
        'version_order' => 'creation'
    ];