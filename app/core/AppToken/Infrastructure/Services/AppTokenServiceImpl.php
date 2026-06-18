<?php

namespace Core\AppToken\Infrastructure\Services;
use Core\AppToken\Domain\Services\AppTokenService;
use Core\AppToken\Domain\Repositories\AppTokenRepositoryInterface;
use Core\AppToken\Domain\Entities\AppToken;

class AppTokenServiceImpl implements AppTokenService
{
    public function __construct(private AppTokenRepositoryInterface $repo) {}

    public function create(array $entity): AppToken
    {
        $entity = AppToken::fromArray($entity);
        return $this->repo->create($entity);
    }
}