<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_list()
    {
        $products = Product::latest()->get();

        return response()->json([
            'status' => 200,
            'data' => $products,
            'message' => 'Product List',
        ]);
    }
}
