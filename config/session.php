<?php
return [
    'driver' => 'redis',
    'connection' => 'session',
    'store' => 'redis',
    'lifetime' => 120,
    'expire_on_close' => true,
    'secure' => true,
    'domain' => '',
    'path' => '/',
    'cookie' => 'PHPSESSID',
    'http_only' => true,
    'same_site' => 'Strict',
    'encrypt' => false,
    'lottery' => [2, 100],
    'partitioned' => false,
];
