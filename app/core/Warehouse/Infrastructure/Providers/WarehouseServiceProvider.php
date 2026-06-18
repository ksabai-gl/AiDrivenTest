<?php

namespace Core\Warehouse\Infrastructure\Providers;

use Core\Warehouse\Domain\Repositories\WarehouseAreaRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Core\Warehouse\Domain\Repositories\WarehouseRepositoryInterface;
use Core\Warehouse\Domain\Services\WarehouseAreaService;
use Core\Warehouse\Infrastructure\Repositories\EloquentWarehouseRepository;
use Core\Warehouse\Domain\Services\WarehouseService;
use Core\Warehouse\Infrastructure\Repositories\EloquentWarehouseAreaRepository;
use Core\Warehouse\Infrastructure\Services\WarehouseAreaServiceImpl;
use Core\Warehouse\Infrastructure\Services\WarehouseServiceImpl;

class WarehouseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(WarehouseRepositoryInterface::class, EloquentWarehouseRepository::class);
        $this->app->bind(WarehouseService::class, WarehouseServiceImpl::class);
        $this->app->bind(WarehouseAreaRepositoryInterface::class, EloquentWarehouseAreaRepository::class);
        $this->app->bind(WarehouseAreaService::class, WarehouseAreaServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('Warehouse') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('Warehouse'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('Warehouse'));
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