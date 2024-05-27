<?php

use App\Http\Controllers\Test;
use Illuminate\Support\Facades\Route;

Route::match(['HEAD', 'GET', 'POST',], '/test', [Test::class, 'test']); // Test

