<?php

namespace Core\PurchaseTax\Http\Controllers;

use Core\PurchaseTax\Application\UseCases\CreatePurchaseTax;
use Core\PurchaseTax\Application\DTOs\CreatePurchaseTaxRequest;
use Core\PurchaseTax\Http\Requests\CreatePurchaseTaxRequest as FormRequest;

class PurchaseTaxController
{
    public function store(FormRequest $request, CreatePurchaseTax $useCase)
    {
        $dto = CreatePurchaseTaxRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
}