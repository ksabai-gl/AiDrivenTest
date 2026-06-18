<?php

namespace Core\StockOut\Http\Controllers;

use Core\StockOut\Application\UseCases\ViewStockOut;
use Illuminate\Http\Request;

class ViewStockOutController
{
    public function index(Request $request, ViewStockOut $useCase)
    {
        
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}