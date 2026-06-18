<?php

namespace Core\StockIn\Http\Controllers;

use Core\StockIn\Application\UseCases\ViewStockIn;
use Illuminate\Http\Request;

class ViewStockInController
{
    public function index(Request $request, ViewStockIn $useCase){
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}