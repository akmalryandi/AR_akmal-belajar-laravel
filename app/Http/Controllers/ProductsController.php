<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name')
            ->paginate(3);
        return view('products.index', ['products' => $products]);
    }
    public function create(){
        $categories = DB::table('product_categories')->get();
		return view('products.create',['categories' => $categories]);
    }

    public function store(Request $request){

        $rules = [
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
        ];

        $messages = [
            'product_name.required' => 'Nama produk harus diisi.',
            'product_code.required' => 'Kode produk harus diisi.',
            'category.required' => 'Kategori produk harus dipilih.',
            'category.exists' => 'Kategori produk tidak valid.',
            'stock.required' => 'Stok produk harus diisi.',
            'stock.numeric' => 'Stok produk harus berupa angka.',
            'price.required' => 'Harga produk harus diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'description.required' => 'Deskripsi produk harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('products.create'))
                ->withErrors($validator)
                ->withInput();
        }

		DB::table('products')->insert([
			'product_name' => $request->product_code,
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

         $rules = [
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
        ];

        $messages = [
            'product_name.required' => 'Nama produk harus diisi.',
            'product_code.required' => 'Kode produk harus diisi.',
            'category.required' => 'Kategori produk harus dipilih.',
            'category.exists' => 'Kategori produk tidak valid.',
            'stock.required' => 'Stok produk harus diisi.',
            'stock.numeric' => 'Stok produk harus berupa angka.',
            'price.required' => 'Harga produk harus diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'description.required' => 'Deskripsi produk harus diisi.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('products.edit', $request->id))
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('products')->where('id',$request->id)->update([
            'product_name' => $request->product_name,
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
