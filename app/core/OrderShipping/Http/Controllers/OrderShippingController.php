<?php

namespace Core\OrderShipping\Http\Controllers;

use Core\OrderShipping\Application\Queries\IndexQuery;
use Core\OrderShipping\Application\UseCases\CreateOrderShipping;
use Core\OrderShipping\Application\UseCases\IndexOrderShipping;
use Core\OrderShipping\Application\UseCases\ShowOrderShipping;
use Core\OrderShipping\Application\UseCases\UpdateOrderShipping;
use Core\OrderShipping\Http\Requests\CreateOrderShippingRequest as FormRequest;
use Core\OrderShipping\Http\Requests\IndexOrderShippingRequest;
use Core\OrderShipping\Http\Requests\ShowOrderShippingRequest;
use Core\OrderShipping\Http\Requests\UpdateOrderShippingRequest;

class OrderShippingController
{
    public function store(FormRequest $request, CreateOrderShipping $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexOrderShippingRequest $request, IndexQuery $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(ShowOrderShippingRequest $request, ShowOrderShipping $useCase, string $id)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(UpdateOrderShipping $useCase,UpdateOrderShippingRequest $request,string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}
