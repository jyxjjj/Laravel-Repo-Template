<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        require_once app_path('helpers.php');
        Route::group([], app_path('Routes/main.php'));
    }

    public function register(): void
    {
    }
}
