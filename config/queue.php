<?php
return [
    'default' => 'redis',
    'connections' => [
        'sync' => [
            'driver' => 'sync',
        ],
        'redis' => [
            'driver' => 'redis',
            'connection' => 'queue',
            'queue' => 'default',
            'retry_after' => 60,
            'block_for' => null,
            'after_commit' => false,
        ],
    ],
    'failed' => [
        'driver' => 'database-uuids',
        'database' => 'mariadb',
        'table' => 'failed_jobs',
    ],
];
