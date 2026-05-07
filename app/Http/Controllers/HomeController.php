<?php

namespace App\Http\Controllers;

use App\Models\Product; // Memanggil model Product
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua data produk dari database
        $products = Product::all();

        // Melempar data produk ke halaman home
        return view('page.home', compact('products'));
    }

    public function showDetail($id)
    {
        $product = Product::findOrFail($id);
        return view('page.detail-product', compact('product'));
    }
}
