<?php

namespace Core\ImageManager\Infrastructure\Repositories;

use App\Models\ImageModel;
use Core\ImageManager\Domain\Repositories\ImageManagerRepositoryInterface;
use Core\ImageManager\Domain\Entities\ImageManager;

class EloquentImageManagerRepository implements ImageManagerRepositoryInterface
{
    public function create(ImageManager $entity): ImageManager
    {
        ImageModel::create($entity->toArray());
        return $entity;
    }
}