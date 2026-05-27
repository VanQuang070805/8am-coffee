<?php

return [
    'default' => env('DB_CONNECTION', 'sqlsrv'),

    'connections' => [
        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST', 'localhost'),
            'port'     => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', '8AMCoffee'),
            'username' => env('DB_USERNAME', 'sa'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'prefix_indexes' => true,
        ],
    ],

    'migrations' => [
        'table'  => 'migrations',
        'update_date_on_publish' => true,
    ],
];
