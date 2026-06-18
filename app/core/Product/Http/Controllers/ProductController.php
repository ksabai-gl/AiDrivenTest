<?php

namespace Core\Product\Http\Controllers;

use Core\Product\Application\UseCases\CreateProduct;
use Core\Product\Application\Queries\IndexQuery;
use Core\Product\Application\UseCases\DeleteProduct;
use Core\Product\Application\UseCases\ShowProduct;
use Core\Product\Application\UseCases\UpdateProduct;
use Core\Product\Http\Requests\CreateProductRequest as FormRequest;
use Core\Product\Http\Requests\DeleteProductRequest;
use Core\Product\Http\Requests\IndexProductRequest;
use Core\Product\Http\Requests\ShowProductRequest;
use Core\Product\Http\Requests\UpdateProductRequest;

class ProductController
{
    public function store(FormRequest $request, CreateProduct $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexProductRequest $request, IndexQuery $useCase) {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(ShowProductRequest $request, string $id, ShowProduct $useCase){
        $request->merge([
            'id' => $id
        ]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(string $id, 
            UpdateProductRequest $request, 
            UpdateProduct $useCase) {
        $request->merge([
            'id' => $id
        ]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function destroy(string $id, 
            DeleteProductRequest $request, 
            DeleteProduct $useCase) {
        $request->merge([
            'id' => $id
        ]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}