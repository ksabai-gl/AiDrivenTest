<?php

namespace Core\Shipping\Http\Controllers;

use App\Http\Controllers\Controller;
use Core\Shipping\Application\UseCases\ViewShipping;
use Illuminate\Http\Request;

class ViewController extends Controller {
    public function index(Request $request, ViewShipping $useCase) {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}