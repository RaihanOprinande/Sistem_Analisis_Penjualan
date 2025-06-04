<?php

namespace App\Providers;

use App\Models\Platfrom;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $platfrom = Platfrom::all();
        view()->share('platfrom', $platfrom);
    }
}
