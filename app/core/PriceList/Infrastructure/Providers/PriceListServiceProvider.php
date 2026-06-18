<?php

namespace Core\PriceList\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\PriceList\Domain\Repositories\PriceListRepositoryInterface;
use Core\PriceList\Infrastructure\Repositories\EloquentPriceListRepository;
use Core\PriceList\Domain\Services\PriceListService;
use Core\PriceList\Infrastructure\Services\PriceListServiceImpl;

class PriceListServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PriceListRepositoryInterface::class, EloquentPriceListRepository::class);
        $this->app->bind(PriceListService::class, PriceListServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('PriceList') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('PriceList'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('PriceList'));
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