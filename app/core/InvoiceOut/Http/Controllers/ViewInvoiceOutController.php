<?php

namespace Core\InvoiceOut\Http\Controllers;

use Core\InvoiceOut\Application\UseCases\ViewInvoiceOut;
use Illuminate\Http\Request;

class ViewInvoiceOutController
{
    public function index(Request $request, ViewInvoiceOut $useCase)
    {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}