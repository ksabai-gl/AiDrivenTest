<?php

namespace Core\Extension\Http\Controllers;

use Core\Extension\Application\UseCases\AllExtension;
use Core\Extension\Application\UseCases\CreateExtension;
use Core\Extension\Application\UseCases\DeleteExtension;
use Core\Extension\Application\UseCases\IndexExtension;
use Core\Extension\Application\UseCases\UpdateExtension;
use Core\Extension\Http\Requests\CreateExtensionRequest as FormRequest;
use Core\Extension\Http\Requests\DeleteExtensionRequest;
use Core\Extension\Http\Requests\IndexExtensionRequest;
use Core\Extension\Http\Requests\UpdateExtensionRequest;

class ExtensionController
{
    public function store(FormRequest $request, CreateExtension $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(UpdateExtensionRequest $request, UpdateExtension $useCase,string $id)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexExtensionRequest $request, AllExtension $useCase) {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function destroy(DeleteExtensionRequest $request, DeleteExtension $useCase,string $id)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}