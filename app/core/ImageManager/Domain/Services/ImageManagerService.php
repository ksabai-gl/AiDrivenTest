<?php

namespace Core\ImageManager\Domain\Services;

use Core\ImageManager\Domain\Entities\ImageManager;

interface ImageManagerService
{
    public function create(array $data): ImageManager;
}