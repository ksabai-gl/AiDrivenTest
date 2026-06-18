<?php

namespace Core\ImageManager\Infrastructure\Services;

use Core\ImageManager\Domain\Services\ImageManagerService;
use Core\ImageManager\Domain\Repositories\ImageManagerRepositoryInterface;
use Core\ImageManager\Domain\Entities\ImageManager;

class ImageManagerServiceImpl implements ImageManagerService
{
    public function __construct(private ImageManagerRepositoryInterface $repo) {}

    public function create(array $data): ImageManager
    {
        $entity = ImageManager::fromArray($data);

        return $this->repo->create($entity);
    }
}