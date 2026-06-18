<?php

namespace Extensions\CustomBusinessRole;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 

        // validate 

        // create 
        $this->app->tag(
            \Extensions\CustomBusinessRole\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        // update 
        $this->app->tag(
            \Extensions\CustomBusinessRole\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // show 
        $this->app->tag(
            \Extensions\CustomBusinessRole\Hooks\ShowHook::class,
            'liteerp.hooks'
        );
        // nav  
        $this->app->tag(
            \Extensions\CustomBusinessRole\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
    }

    public function boot()
    {
        if(env('APP_ENV') !== 'production') {
            /**
             * Only support development 
             */
            $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        }
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }
}