<?php

namespace Core\Product\Http\Controllers;

use Core\Product\Application\UseCases\ViewRender;
use Illuminate\Http\Request;

class ViewProductController
{
    public function index(Request $request, ViewRender $useCase) {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}