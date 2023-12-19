<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {

        $products = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name')
            ->get(); // Sesuaikan query dengan struktur tabel Anda

        return view('home.index', compact('products'));
    }

    public function show($id){
        $product = Product::find($id);
        return view('home.detail', compact('product'));
    }
}
