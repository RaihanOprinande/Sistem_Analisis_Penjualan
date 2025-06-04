<?php

namespace App\Providers;

use App\Interfaces\LoginInterface;
use App\Interfaces\MenuInterface;
use App\Interfaces\PlatfromInterface;
use App\Interfaces\PriceInterface;
use App\Interfaces\RegisterInterface;
use App\Repositories\RegisterRepository;
use App\Repositories\LoginRepository;
use App\Repositories\MenuRepository;
use App\repositories\PlatfromRepository;
use App\Repositories\PriceRepository;
use Illuminate\Support\ServiceProvider;

class AppComponentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LoginInterface::class,LoginRepository::class);
        $this->app->bind(RegisterInterface::class,RegisterRepository::class);
        $this->app->bind(PriceInterface::class,PriceRepository::class);
        $this->app->bind(MenuInterface::class,MenuRepository::class);
        $this->app->bind(PlatfromInterface::class,PlatfromRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
