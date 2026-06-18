<?php

namespace Core\Purchase\Http\Controllers;

use Core\Purchase\Application\UseCases\CreatePurchase;
use Core\Purchase\Application\Queries\IndexQuery;
use Core\Purchase\Application\UseCases\ShowPurchase;
use Core\Purchase\Application\UseCases\UpdatePurchase;
use Core\Purchase\Http\Requests\CreatePurchaseRequest as FormRequest;
use Core\Purchase\Http\Requests\IndexPurchaseRequest;
use Core\Purchase\Http\Requests\ShowPurchaseRequest;
use Core\Purchase\Http\Requests\UpdatePurchaseRequest;

class PurchaseController
{
    public function store(FormRequest $request, CreatePurchase $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexPurchaseRequest $request, IndexQuery $useCase){
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(ShowPurchaseRequest $request, ShowPurchase $useCase, string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(string $id,UpdatePurchaseRequest $request,UpdatePurchase $useCacse) {
        $request->merge(['id' => $id]);
        $entity = $useCacse->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}