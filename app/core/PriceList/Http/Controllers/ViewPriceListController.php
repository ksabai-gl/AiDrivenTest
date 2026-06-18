<?php

namespace Core\PriceList\Http\Controllers;

use Core\PriceList\Application\UseCases\ViewRender;
use Illuminate\Http\Request;

class ViewPriceListController
{
    public function index(Request $request, ViewRender $useCase) {
        $entity = $useCase->handle([]);
        return response()->json(['message' => $entity]);
    }
}