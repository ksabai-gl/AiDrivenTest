<?php

namespace Core\CustomInvoiceIn\Http\Controllers;

use Core\CustomInvoiceIn\Application\UseCases\CreateCustomInvoiceIn;
use Core\CustomInvoiceIn\Application\Queries\IndexQuery;
use Core\CustomInvoiceIn\Application\UseCases\DeleteCustomInvoiceIn;
use Core\CustomInvoiceIn\Application\UseCases\UpdateCustomInvoiceIn;
use Core\CustomInvoiceIn\Http\Requests\CreateCustomInvoiceInRequest as FormRequest;
use Core\CustomInvoiceIn\Http\Requests\DeleteCustomInvoiceInRequest;
use Core\CustomInvoiceIn\Http\Requests\IndexCustomInvoiceInRequest;
use Core\CustomInvoiceIn\Http\Requests\UpdateCustomInvoiceInRequest;

class CustomInvoiceInController
{
    public function store(FormRequest $request, CreateCustomInvoiceIn $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(UpdateCustomInvoiceInRequest $request, 
        UpdateCustomInvoiceIn $useCase, string $id)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexCustomInvoiceInRequest $request, 
        IndexQuery $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function destroy(DeleteCustomInvoiceInRequest $request, 
        DeleteCustomInvoiceIn $useCase,string $id)
    {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}