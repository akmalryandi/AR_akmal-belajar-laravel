<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
		$products = DB::table('product_view')->orderBy('id', 'ASC')->paginate(3);
		return view('products.index',['products' => $products]);
    }
    public function create(){
        $categories = DB::table('product_categories')->get();
		return view('products.create',['categories' => $categories]);
    }

    public function store(Request $request){

		DB::table('products')->insert([
			'product_name' => $request->nama,
			'description' => $request->description,
			'price' => $request->price,
			'stock' => $request->stock,
            'product_code' => $request->product_code,
            'category_id' => $request->category,
		]);

		return redirect('/products')->with("success","Data Berhasil Ditambah");
    }

    public function edit($id){
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('product_categories')->pluck('category_name', 'id');
        return view('products.edit', compact('product', 'categories'));
	}

    public function update(Request $request){
        DB::table('products')->where('id',$request->id)->update([
            'product_name' => $request->nama,
			'description' => $request->description,
			'price' => $request->price,
			'stock' => $request->stock,
            'product_code' => $request->product_code,
            'category_id' => $request->category,
            ]);
            return redirect('/products')->with('success','Data Berhasil Diedit');
    }

    public function destroy($id){
        DB::table('products')->where('id',$id)->delete();
        return redirect('/products')->with('success','Data Berhasil Dihapus');
    }

}
