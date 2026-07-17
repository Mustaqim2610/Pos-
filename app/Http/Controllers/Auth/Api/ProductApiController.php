<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Product::with('category')->get()
        ]);
    }

    public function show($id)
    {
        $product = Product::with('category')
                    ->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $products = Product::where(
            'name',
            'like',
            "%{$keyword}%"
        )->get();

        return response()->json($products);
    }
}