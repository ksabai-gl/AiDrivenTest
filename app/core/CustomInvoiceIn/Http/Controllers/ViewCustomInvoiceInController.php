<?php

namespace Core\CustomInvoiceIn\Http\Controllers;

use Core\CustomInvoiceIn\Application\UseCases\ViewCustomInvoiceIn;
use Illuminate\Http\Request;

class ViewCustomInvoiceInController
{
    public function index(Request $request, 
        ViewCustomInvoiceIn $useCase)
    {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}