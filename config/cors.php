<?php

return [
    'paths' => ['api/*',],
    'allowed_methods' => ['GET', 'POST',],
    'allowed_origins' => [],
    'allowed_origins_patterns' => [
        '/localhost/',
    ],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
