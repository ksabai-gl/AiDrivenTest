<?php

namespace Core\InvoiceIn\Http\Controllers;

use Core\InvoiceIn\Application\UseCases\CreateInvoiceIn;
use Core\InvoiceIn\Application\Queries\IndexQuery;
use Core\InvoiceIn\Application\UseCases\ShowInvoiceIn;
use Core\InvoiceIn\Application\UseCases\UpdateInvoiceIn;
use Core\InvoiceIn\Http\Requests\CreateInvoiceInRequest as FormRequest;
use Core\InvoiceIn\Http\Requests\IndexInvoiceInRequest;
use Core\InvoiceIn\Http\Requests\ShowInvoiceInRequest;
use Core\InvoiceIn\Http\Requests\UpdateInvoiceInRequest;

class InvoiceInController
{
    public function store(FormRequest $request, CreateInvoiceIn $useCase)
    {
        
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexInvoiceInRequest $request,IndexQuery $useCase) {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(string $id,UpdateInvoiceInRequest $request,UpdateInvoiceIn $useCase) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(ShowInvoiceInRequest $request,ShowInvoiceIn $useCase,string $id) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}