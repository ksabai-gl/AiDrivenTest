<?php

namespace Extensions\Hrm;

use Extensions\Hrm\Consoles\MonthSummaryCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
        $this->app->tag(
            \Extensions\Hrm\Hooks\AddNavMenu::class,
            'liteerp.hooks'
        );
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/Resources/views','hrm');
        $this->loadTranslationsFrom(__DIR__ . '/lang','extension.hrm');
        if ($this->app->runningInConsole()) {
            $this->commands([
                MonthSummaryCommand::class
            ]);
        }
        $this->app->booted(function () {
            app(Schedule::class)
                ->command('extension:hrm-export')
                ->monthlyOn(1, '00:05')
                ->withoutOverlapping()
                ->onOneServer();
        });
    }
}