<?php

namespace Core\OrderCancel\Http\Controllers;

use Core\OrderCancel\Application\UseCases\CreateOrderCancel;
use Core\OrderCancel\Application\DTOs\CreateOrderCancelRequest;
use Core\OrderCancel\Http\Requests\CreateOrderCancelRequest as FormRequest;

class CreateOrderCancelController
{
    public function __invoke(FormRequest $request, CreateOrderCancel $useCase)
    {
        $dto = CreateOrderCancelRequest::fromArray($request->validated());
        $entity = $useCase->handle($dto);
        return response()->json(['created' => $entity]);
    }
}