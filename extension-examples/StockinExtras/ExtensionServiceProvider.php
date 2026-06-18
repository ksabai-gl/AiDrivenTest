<?php

namespace Extensions\StockinExtras;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\SearchIndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\ValidateSearchHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\ValidateUpdateHook::class,
            'liteerp.hooks'
        );
        // create 
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        // update 
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // index 
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\IndexHook::class,
            'liteerp.hooks'
        );
        // show 
        $this->app->tag(
            \Extensions\StockinExtras\Hooks\ShowHook::class,
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