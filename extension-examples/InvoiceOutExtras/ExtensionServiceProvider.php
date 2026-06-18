<?php

namespace Extensions\InvoiceOutExtras;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\SearchIndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\ValidateSearchHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        // create 
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        // update 
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // index 
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\IndexHook::class,
            'liteerp.hooks'
        );
        // show 
        $this->app->tag(
            \Extensions\InvoiceOutExtras\Hooks\ShowHook::class,
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