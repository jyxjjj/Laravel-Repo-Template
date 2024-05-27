<?php
return [
    'driver' => 'argon2id',
    'bcrypt' => [
        'rounds' => 12,
        'verify' => true,
    ],
    'argon' => [
        'memory' => 65536,
        'threads' => 2,
        'time' => 4,
    ],
];
