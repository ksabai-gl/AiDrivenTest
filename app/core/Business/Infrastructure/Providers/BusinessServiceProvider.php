<?php

namespace Core\Business\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\Business\Domain\Repositories\BusinessRepositoryInterface;
use Core\Business\Infrastructure\Repositories\EloquentBusinessRepository;
use Core\Business\Domain\Services\BusinessService;
use Core\Business\Infrastructure\Services\BusinessServiceImpl;

class BusinessServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BusinessRepositoryInterface::class, EloquentBusinessRepository::class);
        $this->app->bind(BusinessService::class, BusinessServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('Business') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('Business'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('Business'));
        }
    }

    protected function loadModuleRoutes(): void
    {
        $routePath = __DIR__ . '/../routes';
        if (file_exists("$routePath/api.php")) {
            $this->loadRoutesFrom("$routePath/api.php");
        }
        if (file_exists("$routePath/web.php")) {
            $this->loadRoutesFrom("$routePath/web.php");
        }
    }
}