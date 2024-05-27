<?php

$FILE_PERMISSIONS = [
    'file' => [
        'public' => 0644,
        'private' => 0644,
    ],
    'dir' => [
        'public' => 0755,
        'private' => 0755,
    ],
];

return [
    'default' => 'local',
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'permissions' => $FILE_PERMISSIONS,
        ],
    ],
    'links' => [
    ],
];
