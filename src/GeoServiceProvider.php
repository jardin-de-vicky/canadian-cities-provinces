<?php

namespace Jdv\Geo;

use Jdv\Geo\App\Console\GeoProceedInstallCommand;
use Illuminate\Support\ServiceProvider;

class GeoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                GeoProceedInstallCommand::class
            ]);
        }

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Geo::class, function(){
            return new Geo();
        });
        $this->app->alias(Geo::class, 'CanadaGeo');
    }

}
