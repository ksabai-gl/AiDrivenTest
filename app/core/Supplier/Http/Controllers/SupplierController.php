<?php

namespace Core\Supplier\Http\Controllers;

use Core\Supplier\Application\UseCases\CreateSupplier;
use Core\Supplier\Application\Queries\IndexQuery;
use Core\Supplier\Application\UseCases\DeleteSupplier;
use Core\Supplier\Application\UseCases\UpdateSupplier;
use Core\Supplier\Http\Requests\CreateSupplierRequest as FormRequest;
use Core\Supplier\Http\Requests\DeleteSupplierRequest;
use Core\Supplier\Http\Requests\IndexSupplierRequest;
use Core\Supplier\Http\Requests\UpdateSupplierRequest;

class SupplierController
{
    public function index(IndexSupplierRequest $request, IndexQuery $useCase){
        
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function store(FormRequest $request, CreateSupplier $useCase)
    {
        
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(UpdateSupplierRequest $request,UpdateSupplier $useCase,string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function destroy(DeleteSupplierRequest $request,
        DeleteSupplier $useCase,string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}