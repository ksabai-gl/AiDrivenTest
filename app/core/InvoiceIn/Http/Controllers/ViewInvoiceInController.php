<?php

namespace Core\InvoiceIn\Http\Controllers;

use Core\InvoiceIn\Application\UseCases\ViewInvoiceIn;
use Illuminate\Http\Request;

class ViewInvoiceInController
{
    public function index(Request $request,ViewInvoiceIn $useCase) {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}