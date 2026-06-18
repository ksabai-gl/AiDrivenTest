<?php

namespace Core\AppToken\Http\Controllers;

use Core\AppToken\Application\UseCases\CreateAppToken;
use Core\AppToken\Application\DTOs\CreateAppTokenRequest;
use Core\AppToken\Http\Requests\CreateAppTokenRequest as FormRequest;

// class CreateAppTokenController
// {
//     public function store(FormRequest $request, CreateAppToken $useCase)
//     {
//         $dto = CreateAppTokenRequest::fromArray($request->validated());
//         $entity = $useCase->handle($dto);
//         return response()->json(['created' => $entity]);
//     }
// }