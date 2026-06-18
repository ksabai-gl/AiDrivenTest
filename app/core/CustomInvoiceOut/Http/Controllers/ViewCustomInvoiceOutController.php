<?php

namespace Core\CustomInvoiceOut\Http\Controllers;

use Core\CustomInvoiceOut\Application\UseCases\ViewCustomInvoiceOut;
use Illuminate\Http\Request;

class ViewCustomInvoiceOutController
{
    public function index(Request $request, ViewCustomInvoiceOut $useCase)
    {
        
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}