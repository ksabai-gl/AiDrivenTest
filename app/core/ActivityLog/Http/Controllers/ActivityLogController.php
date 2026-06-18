<?php

namespace Core\ActivityLog\Http\Controllers;

use Core\ActivityLog\Application\UseCases\IndexActivityLog;
use Core\ActivityLog\Http\Requests\IndexActivityLogRequest;

class ActivityLogController
{
    // public function store(FormRequest $request, CreateActivityLog $useCase)
    // {
    //     $dto = CreateActivityLogRequest::fromArray($request->validated());
    //     $entity = $useCase->handle($dto);
    //     return response()->json(['message' => $entity]);
    // }
    public function index(
        IndexActivityLog $useCase,
        IndexActivityLogRequest $request
    ) {
            $entity = $useCase->handle($request->all());
            return response()->json(['message' => $entity]);  
    }
}
