<?php

namespace Core\Supplier\Http\Controllers;

use Core\Supplier\Application\UseCases\ViewSupplier;
use Illuminate\Http\Request;

class ViewSupplierController
{
    public function index(Request $request, ViewSupplier $useCase){
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}