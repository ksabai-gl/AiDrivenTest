<?php

namespace Core\Shipping\Http\Controllers;

use Core\Business\Http\Requests\ShowBusinessRequest;
use Core\Shipping\Application\UseCases\CreateShipping;
use Core\Shipping\Application\Queries\IndexQuery;
use Core\Shipping\Application\UseCases\DeleteShipping;
use Core\Shipping\Application\UseCases\ShowShipping;
use Core\Shipping\Application\UseCases\UpdateShipping;
use Core\Shipping\Http\Requests\CreateShippingRequest as FormRequest;
use Core\Shipping\Http\Requests\DeleteShippingRequest;
use Core\Shipping\Http\Requests\IndexShippingRequest;
use Core\Shipping\Http\Requests\UpdateShippingRequest;

class ShippingController
{
    public function store(FormRequest $request, CreateShipping $useCase)
    {
        
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexShippingRequest $request, IndexQuery $useCase) {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(ShowBusinessRequest $request,ShowShipping $useCase,string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(UpdateShippingRequest $request, 
        UpdateShipping $useCase,string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function destroy(DeleteShippingRequest $request, 
        DeleteShipping $useCase,string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}