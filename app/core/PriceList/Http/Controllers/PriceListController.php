<?php

namespace Core\PriceList\Http\Controllers;

use Core\PriceList\Application\UseCases\CreatePriceList;
use Core\PriceList\Application\Queries\IndexQuery;
use Core\PriceList\Application\UseCases\DeletePriceList;
use Core\PriceList\Application\UseCases\UpdatePriceList;
use Core\PriceList\Http\Requests\CreatePriceListRequest as FormRequest;
use Core\PriceList\Http\Requests\DeletePriceListRequest;
use Core\PriceList\Http\Requests\IndexPriceListRequest;
use Core\PriceList\Http\Requests\UpdatePriceListRequest;

class PriceListController
{
    public function store(FormRequest $request, CreatePriceList $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    
    public function update(UpdatePriceListRequest $request, UpdatePriceList $useCase, string $id)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    
    public function index(IndexPriceListRequest $request, IndexQuery $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    
    public function destroy(DeletePriceListRequest $request, DeletePriceList $useCase, string $id)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}