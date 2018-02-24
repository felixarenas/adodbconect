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

            $driver = config('dbConfig.DB_DRIVER');
            $server = config('dbConfig.DB_HOST');
            $puerto = config('dbConfig.DB_PORT');
            $user = config('dbConfig.DB_USERNAME');
            $password = config('dbConfig.DB_PASSWORD');
            $database = config('dbConfig.DB_DATABASE');

            return new AdodbConect($driver, $server, $puerto, $user, $password, $database);
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