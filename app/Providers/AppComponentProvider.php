<?php

namespace App\Providers;

use App\Interfaces\AnalisisInterface;
use App\Interfaces\CommissionInterface;
use App\Interfaces\LoginInterface;
use App\Interfaces\MenuInterface;
use App\Interfaces\PlatfromInterface;
use App\Interfaces\PriceInterface;
use App\Interfaces\RegisterInterface;
use App\Interfaces\TransaksiInterface;
use App\Repositories\AnalisisRepository;
use App\Repositories\CommissionRepository;
use App\Repositories\RegisterRepository;
use App\Repositories\LoginRepository;
use App\Repositories\MenuRepository;
use App\repositories\PlatfromRepository;
use App\Repositories\PriceRepository;
use App\Repositories\TransaksiRepository;
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
        $this->app->bind(CommissionInterface::class,CommissionRepository::class);
        $this->app->bind(TransaksiInterface::class,TransaksiRepository::class);
        $this->app->bind(AnalisisInterface::class,AnalisisRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
