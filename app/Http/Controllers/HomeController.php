<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function productStats()
    {
        // Product stats Card
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalPrice = Product::sum('price');
        $totalStock = Product::sum('stock');

        // Product stats Column and Bar
        $categories = Category::withCount('products')->get();

        // Price stats Pie
        $categoriesPrice = Category::with([
            'products' => function ($query) {
                $query->select('category_id', DB::raw('SUM(price) as total_price'))
                    ->groupBy('category_id');
            }
        ])->get();

        $chartDataPrice = [];

        foreach ($categoriesPrice as $category) {
            $chartDataPrice[] = [
                'name' => $category->category_name,
                'y' => $category->products->sum('total_price'),
            ];
        }

        // Stock stats pie
        $categoriesStock = Category::with([
            'products' => function ($query) {
                $query->select('category_id', DB::raw('SUM(stock) as total_stock'))
                    ->groupBy('category_id');
            }
        ])->get();

        $chartDataStock = [];

        foreach ($categoriesStock as $category) {
            $chartDataStock[] = [
                'name' => $category->category_name,
                'y' => $category->products->sum('total_stock'),
            ];
        }



        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalPrice', 'totalStock', 'chartDataPrice', 'chartDataStock', 'categories'));
    }
}
