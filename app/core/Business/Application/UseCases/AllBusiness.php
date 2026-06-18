<?php

namespace Core\Business\Application\UseCases;

use Core\Business\Domain\Services\BusinessService;

class AllBusiness
{
    public function __construct(private BusinessService $service) {}

    public function handle()
    {
        return $this->service->all();
    }
}