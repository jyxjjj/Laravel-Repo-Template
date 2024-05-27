<?php

return [
    'default' => 'single',
    'deprecations' => 'deprecations',
    'channels' => [
        'single' => [
            'driver' => 'single',
            'name' => 'emergency',
            'path' => storage_path("logs/single.log"),
            'days' => 3,
            'level' => 'debug',
            'permission' => 0644,
            'bubble' => false,
            'locking' => false,
        ],
        'deprecations' => [
            'driver' => 'single',
            'name' => 'emergency',
            'path' => storage_path("logs/deprecations.log"),
            'days' => 3,
            'level' => 'debug',
            'permission' => 0644,
            'bubble' => false,
            'locking' => false,
        ],
        'emergency' => [
            'driver' => 'single',
            'name' => 'emergency',
            'path' => storage_path("logs/emergency.log"),
            'days' => 3,
            'level' => 'debug',
            'permission' => 0644,
            'bubble' => false,
            'locking' => false,
        ],
    ],
];
