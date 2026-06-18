<?php

namespace Core\ImageManager\Domain\Repositories;

use Core\ImageManager\Domain\Entities\ImageManager;

interface ImageManagerRepositoryInterface
{
    public function create(ImageManager $entity): ImageManager;
}