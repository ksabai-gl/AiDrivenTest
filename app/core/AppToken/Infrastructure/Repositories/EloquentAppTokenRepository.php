<?php

namespace Core\AppToken\Infrastructure\Repositories;

use Core\AppToken\Domain\Repositories\AppTokenRepositoryInterface;
use Core\AppToken\Domain\Entities\AppToken;

class EloquentAppTokenRepository implements AppTokenRepositoryInterface
{
    public function create(AppToken $entity): AppToken
    {
        return $entity;
    }
}
