<?php

namespace Core\PurchaseTax\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\PurchaseTax\Domain\Repositories\PurchaseTaxRepositoryInterface;
use Core\PurchaseTax\Infrastructure\Repositories\EloquentPurchaseTaxRepository;
use Core\PurchaseTax\Domain\Services\PurchaseTaxService;
use Core\PurchaseTax\Infrastructure\Services\PurchaseTaxServiceImpl;

class PurchaseTaxServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PurchaseTaxRepositoryInterface::class, EloquentPurchaseTaxRepository::class);
        $this->app->bind(PurchaseTaxService::class, PurchaseTaxServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('PurchaseTax') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('PurchaseTax'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('PurchaseTax'));
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