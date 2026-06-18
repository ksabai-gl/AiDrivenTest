<?php

namespace Core\StockOut\Http\Controllers;

use Core\StockOut\Application\UseCases\CreateStockOut;
use Core\StockOut\Application\Queries\IndexQuery;
use Core\StockOut\Application\UseCases\ShowStockOut;
use Core\StockOut\Application\UseCases\UpdateStockOut;
use Core\StockOut\Http\Requests\CreateStockOutRequest as FormRequest;
use Core\StockOut\Http\Requests\IndexStockOutRequest;
use Core\StockOut\Http\Requests\ShowStockOutRequest;
use Core\StockOut\Http\Requests\UpdateStockOutRequest;

class StockOutController
{
    public function store(FormRequest $request, CreateStockOut $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexStockOutRequest $request, IndexQuery $useCase)
    {
        
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(string $id, UpdateStockOut $useCase, UpdateStockOutRequest $request)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(
        string $id,
        ShowStockOut $useCase,
        ShowStockOutRequest $request
    ) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}
