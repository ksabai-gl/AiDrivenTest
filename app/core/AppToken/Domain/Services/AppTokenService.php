<?php

namespace Core\AppToken\Domain\Services;
use Core\AppToken\Domain\Entities\AppToken;

interface AppTokenService
{
    public function create(array $data): AppToken;
}