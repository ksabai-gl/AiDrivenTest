<?php

namespace Core\Order\Http\Controllers;

use Core\Order\Application\UseCases\ViewRender;
use Illuminate\Http\Request;

class ViewOrderController
{
    public function index(Request $request, ViewRender $useCase) {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}