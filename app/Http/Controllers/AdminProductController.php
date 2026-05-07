<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_code' => 'required|string|max:50|unique:products,product_code',
            'name'         => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|integer|min:0',
            'image'        => 'required|image|max:2048',
        ]);

        // Simpan gambar ke storage/app/public/products/
        $imagePath = $request->file('image')->store('products', 'public');

        $newProduct = Product::create([
            'product_code' => $validated['product_code'],
            'name'         => $validated['name'],
            'description'  => $validated['description'],
            'price'        => $validated['price'],
            'image'        => $imagePath,
        ]);

        return redirect()->route('product.detail', $newProduct->id)->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_code' => 'required|string|max:50|unique:products,product_code,' . $id,
            'name'         => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|integer|min:0',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = [
            'product_code' => $validated['product_code'],
            'name'         => $validated['name'],
            'description'  => $validated['description'],
            'price'        => $validated['price'],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.product.list')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.product.list')->with('success', 'Produk berhasil dihapus.');
    }

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product-list', compact('products'));
    }
}
