<?php

namespace Extensions\Debt;

use Extensions\Debt\Commands\MakeCache;
use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
        $this->app->tag(
            \Extensions\Debt\Hooks\AddNavMenu::class,
            'liteerp.hooks'
        );
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Resources/views','Debt');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'debt');
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCache::class
            ]);
        }
    }
}
