<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

if (PHP_MAJOR_VERSION != 8 || PHP_MINOR_VERSION != 4) {
    echo "PHP Version Mismatch\n";
    exit(130);
}

define('LARAVEL_START', new DateTime()->format('U.u'));

require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->handleRequest(Request::capture());
