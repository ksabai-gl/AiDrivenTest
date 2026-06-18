<?php

namespace Core\StockIn\Http\Controllers;

use Core\StockIn\Application\UseCases\CreateStockIn;
use Core\StockIn\Application\Queries\IndexQuery;
use Core\StockIn\Application\UseCases\ShowStockIn;
use Core\StockIn\Application\UseCases\UpdateStockIn;
use Core\StockIn\Http\Requests\CreateStockInRequest as FormRequest;
use Core\StockIn\Http\Requests\IndexStockInRequest;
use Core\StockIn\Http\Requests\ShowStockInRequest;
use Core\StockIn\Http\Requests\UpdateStockInRequest;

class StockInController
{
    public function store(FormRequest $request, CreateStockIn $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexStockInRequest $request, IndexQuery $useCase){
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(string $id,ShowStockInRequest $request, ShowStockIn $useCase){
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(string $id, UpdateStockIn $useCase, UpdateStockInRequest $request) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}