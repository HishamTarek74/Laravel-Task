<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\GeneralTrait;

class ProductsApiController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $products = Product::with('category')->get();
        //return response()->json($categories);

        return $this -> returnData('products',$products);
    }
}
