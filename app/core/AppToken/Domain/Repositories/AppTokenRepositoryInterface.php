<?php

namespace Core\AppToken\Domain\Repositories;

use Core\AppToken\Domain\Entities\AppToken;

interface AppTokenRepositoryInterface
{
    public function create(AppToken $entity): AppToken;
}