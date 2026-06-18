<?php

namespace Core\Purchase\Http\Controllers;

use Core\Purchase\Application\UseCases\ViewPurchase;
use Illuminate\Http\Request;

class ViewPurchaseController
{
    public function index(Request $request, ViewPurchase $useCase){
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}