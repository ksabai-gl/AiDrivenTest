<?php

namespace Core\OrderShipping\Http\Controllers;

use App\Http\Controllers\Controller;
use Core\OrderShipping\Application\UseCases\ViewRender;
use Illuminate\Http\Request;

class ViewOrderShippingController extends Controller {
    public function index(Request $request, ViewRender $useCase)
    {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}