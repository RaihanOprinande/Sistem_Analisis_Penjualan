<?php

namespace App\Providers;

use App\Interfaces\LoginInterface;
use App\Repositories\LoginRepository;
use Illuminate\Support\ServiceProvider;

class AppComponentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LoginInterface::class,LoginRepository::class);
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
