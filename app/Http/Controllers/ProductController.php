<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('produk.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('produk.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $data['photo'] = $request->file('photo')->store('products', 'public');
        } else {
            unset($data['photo']);
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
