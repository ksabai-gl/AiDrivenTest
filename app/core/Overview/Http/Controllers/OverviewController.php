<?php

namespace Core\Overview\Http\Controllers;

use Core\Overview\Application\UseCases\IndexOverview;
use Core\Overview\Http\Requests\IndexOverviewRequest;

class OverviewController
{
    public function index(IndexOverviewRequest $request, IndexOverview $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
}