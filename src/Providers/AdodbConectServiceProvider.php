<?php
namespace farenas\AdodbConect\Providers;

use Illuminate\Support\ServiceProvider;
use farenas\AdodbConect\classAdodb\AdodbConect;
use farenas\AdodbConect\Console\Commands\AdodbInitConfigCommand;

class AdodbConectServiceProvider extends ServiceProvider{

    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this -> publishConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(AdodbConect::class, function ($app) {

            return new AdodbConect();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {

        return [AdodbConect::class];
    }

    private function publishConfig()
    {

        $this->publishes([__DIR__.'/../Config/dbConfig.php' => config_path('dbConfig.php')], 'config');
    }
}