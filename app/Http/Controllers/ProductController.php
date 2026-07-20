<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Helpers\Upload;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
                    ->latest()
                    ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function index()
    {
    $products = $this->productService->getProducts();

    return view(
        'products.index',
        compact('products')
    );
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        Product::create($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()
            ->with('success', 'Produk berhasil dihapus');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

    return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function store(ProductRequest $request,ProductService $service) 
    {
        $service->store($request->validated()
        );

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );

        $image = Upload::image(
    $request->file('gambar')
        );
    }
}