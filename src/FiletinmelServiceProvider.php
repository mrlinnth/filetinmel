<?php

namespace Mrlinnth\Filetinmel;

use Illuminate\Support\ServiceProvider;

class FiletinmelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $publishablePath = dirname(__DIR__) . '/publishable';

        $this->loadRoutesFrom(dirname(__DIR__) . '/routes/api.php');

        $this->loadRoutesFrom(dirname(__DIR__) . '/routes/web.php');

        $this->loadViewsFrom(dirname(__DIR__) . '/resources/views', 'filetinmel');

        if ($this->app->runningInConsole()) {

            $this->loadMigrationsFrom(dirname(__DIR__) . '/database/migrations');

            $this->publishes([
                $publishablePath . '/config/filetinmel.php' => config_path('filetinmel.php'),
            ], 'filetinmel');
            $this->publishes([
                $publishablePath . '/config/youtube.php' => config_path('youtube.php'),
            ], 'filetinmel');

            $this->publishes([
                $publishablePath . '/assets' => public_path('vendor/filetinmel'),
            ], 'filetinmel');

            $this->publishes([
                dirname(__DIR__) . '/resources/views' => resource_path('views/vendor/filetinmel'),
            ], 'filetinmel');

            $this->publishes([
                dirname(__DIR__) . '/resources/assets/js/components' => resource_path('js/components/filetinmel'),
            ], 'filetinmel');

        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/publishable/config/filetinmel.php', 'filetinmel');
        $this->mergeConfigFrom(dirname(__DIR__) . '/publishable/config/youtube.php', 'youtube');

        $this->app->singleton('filetinmel', function ($app) {
            return new Filetinmel($app);
        });

        $this->app->singleton('youtube', function ($app) {
            return new Youtube($app, new \Google_Client);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //
    }

}
