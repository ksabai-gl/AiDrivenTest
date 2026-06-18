<?php

namespace Core\Extension\Application\UseCases;

use Core\Extension\Domain\Services\ExtensionService;

class AllExtension
{
    public function __construct(private ExtensionService $service) {}

    public function handle()
    {
        return $this->service->all();
    }
}