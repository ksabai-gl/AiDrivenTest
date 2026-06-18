<?php

namespace Core\CategoryProduct\Http\Controllers;

use Core\CategoryProduct\Application\UseCases\ViewCategoryProduct;
use Illuminate\Http\Request;

class CategoryProductViewController
{
    public function index(Request $request, ViewCategoryProduct $useCase)
    {
        return response()->json(['message' => $useCase->handle([])]);
    }
}