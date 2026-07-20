<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /** Kasir page */
    public function create()
    {
        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('penjualan.create', compact('products'));
    }

    /** Process sale (AJAX) */
    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|string',
            'paid' => 'required|numeric|min:0',
        ]);

        $cart = json_decode($request->cart, true);

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong.'], 422);
        }

        DB::beginTransaction();
        try {
            $total = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);

            $invoice = 'INV/' . now()->format('Ymd/His');

            $sale = Sale::create([
                'invoice' => $invoice,
                'user_id' => auth()->id(),
                'total'   => $total,
                'paid'    => $request->paid,
                'change'  => $request->paid - $total,
                'status'  => 'paid',
            ]);

            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stok {$product->name} tidak cukup.");
                }

                TransactionDetail::create([
                    'transaction_id' => $sale->id,
                    'product_id'     => $product->id,
                    'qty'            => $item['qty'],
                    'price'          => $item['price'],
                    'subtotal'       => $item['price'] * $item['qty'],
                ]);

                $product->decrement('stock', $item['qty']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'sale' => [
                    'invoice'  => $sale->invoice,
                    'date'     => $sale->created_at->format('d/m/Y H:i'),
                    'cashier'  => auth()->user()->name,
                    'total'    => $sale->total,
                    'paid'     => $sale->paid,
                    'change'   => $sale->change,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /** Transaction history list */
    public function index(Request $request)
    {
        $sales = Sale::with('user')
            ->when($request->q, fn ($q, $v) => $q->where('invoice', 'like', "%$v%"))
            ->when($request->from, fn ($q, $v) => $q->whereDate('created_at', '>=', $v))
            ->when($request->to,   fn ($q, $v) => $q->whereDate('created_at', '<=', $v))
            ->latest()
            ->paginate(15);

        return view('transaksi.index', compact('sales'));
    }

    /** Ajax detail */
    public function detail(Sale $sale)
    {
        $sale->load(['user', 'details.product']);

        return response()->json([
            'invoice' => $sale->invoice,
            'date'    => $sale->created_at->format('d M Y, H:i'),
            'cashier' => $sale->user->name ?? '-',
            'total'   => $sale->total,
            'paid'    => $sale->paid,
            'change'  => $sale->change,
            'details' => $sale->details->map(fn ($d) => [
                'product_name' => $d->product->name ?? '-',
                'qty'          => $d->qty,
                'price'        => $d->price,
                'subtotal'     => $d->subtotal,
            ]),
        ]);
    }
}
