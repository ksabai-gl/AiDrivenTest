<?php

namespace Core\InvoiceOut\Http\Controllers;

use Core\InvoiceOut\Application\UseCases\CreateInvoiceOut;
use Core\InvoiceOut\Application\DTOs\CreateInvoiceOutRequest;
use Core\InvoiceOut\Application\DTOs\IndexInvoiceOutRequest as DTOsIndexInvoiceOutRequest;
use Core\InvoiceOut\Application\DTOs\ShowInvoiceOutRequest as DTOsShowInvoiceOutRequest;
use Core\InvoiceOut\Application\Queries\IndexQuery;
use Core\InvoiceOut\Application\UseCases\IndexInvoiceOut;
use Core\InvoiceOut\Application\UseCases\ShowInvoiceOut;
use Core\InvoiceOut\Application\UseCases\UpdateInvoiceOut;
use Core\InvoiceOut\Http\Requests\CreateInvoiceOutRequest as FormRequest;
use Core\InvoiceOut\Http\Requests\IndexInvoiceOutRequest;
use Core\InvoiceOut\Http\Requests\ShowInvoiceOutRequest;
use Core\InvoiceOut\Http\Requests\UpdateInvoiceOutRequest;

class InvoiceOutController
{
    public function store(FormRequest $request, CreateInvoiceOut $useCase)
    {

        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function index(IndexInvoiceOutRequest $request, IndexQuery $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(
        UpdateInvoiceOut $useCase,
        UpdateInvoiceOutRequest $request,
        string $id
    ) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function show(
        string $id,
        ShowInvoiceOutRequest $request,
        ShowInvoiceOut $useCase
    ) {
        $request->merge(['id' => $id]);
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}
