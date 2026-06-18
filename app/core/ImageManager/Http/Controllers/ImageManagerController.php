<?php

namespace Core\ImageManager\Http\Controllers;

use Core\ImageManager\Application\UseCases\CreateImageManager;
use Core\ImageManager\Application\DTOs\CreateImageManagerRequest;
use Core\ImageManager\Http\Requests\CreateImageManagerRequest as FormRequest;

class ImageManagerController
{
    public function store(FormRequest $request, CreateImageManager $useCase)
    {
        $dto = CreateImageManagerRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
}