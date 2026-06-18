<?php

namespace Core\CustomInvoiceOut\Http\Controllers;

use Core\CustomInvoiceOut\Application\UseCases\CreateCustomInvoiceOut;
use Core\CustomInvoiceOut\Application\Queries\IndexQuery;
use Core\CustomInvoiceOut\Application\UseCases\DeleteCustomInvoiceOut;
use Core\CustomInvoiceOut\Application\UseCases\UpdateCustomInvoiceOut;
use Core\CustomInvoiceOut\Http\Requests\CreateCustomInvoiceOutRequest as FormRequest;
use Core\CustomInvoiceOut\Http\Requests\DeleteCustomInvoiceOutRequest;
use Core\CustomInvoiceOut\Http\Requests\IndexCustomInvoiceOutRequest;
use Core\CustomInvoiceOut\Http\Requests\UpdateCustomInvoiceOutRequest;

class CustomInvoiceOutController
{
    public function store(FormRequest $request, CreateCustomInvoiceOut $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexCustomInvoiceOutRequest $request, IndexQuery $useCase)
    {
        
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(UpdateCustomInvoiceOutRequest $request, 
        UpdateCustomInvoiceOut $useCase,string $id)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function destroy(DeleteCustomInvoiceOutRequest $request, 
        DeleteCustomInvoiceOut $useCase,string $id)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}