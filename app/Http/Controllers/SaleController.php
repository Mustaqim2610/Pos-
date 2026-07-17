<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::latest()->paginate(15);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();

        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $product = Product::findOrFail(
                $request->product_id
            );

            if ($product->stock < $request->qty) {
                return back()
                    ->with('error', 'Stok tidak cukup');
            }

            $total = $product->price * $request->qty;

            Sale::create([
                'invoice' => 'INV' . time(),
                'product_id' => $product->id,
                'qty' => $request->qty,
                'total' => $total
            ]);

            $product->decrement(
                'stock',
                $request->qty
            );

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with('success', 'Transaksi berhasil');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}