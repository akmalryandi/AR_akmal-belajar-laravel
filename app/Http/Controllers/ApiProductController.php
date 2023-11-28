<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{

    public function index()
    {
        $product = Product::all();
        return response()->json(['status' => 'success', 'data' => $product,]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json(['status' => 'success', 'data' => $product,]);
        } else {
            return response()->json([
                'massage' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_code' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'errorr',
                'massage' => 'Data tidak valid',
                'Data' => null
            ], 422);
        }
        $products = Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_code' => $request->product_code,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'status' => 'success',
            'massage' => 'Data Berhasil dibuat',
            'Data' => $products
        ]);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_code' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'errorr',
                'massage' => 'Data tidak valid',
                'Data' => $validate->errors()
            ], 422);
        }
        $products = Product::where('id', $id)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_code' => $request->product_code,
            'category_id' => $request->category_id,
        ]);

        if ($products) {
            $product = Product::find($id);
            return response()->json(['massage' => 'Data berhasil di update','data' => $product]);
        }

    }
    public function destroy($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'errorr',
                'massage' => 'data tidak ditemukan',
                'data' => null
            ], 422);
        }
        $product->delete();
        return response()->json([
            'status' => 'success',
            'massage' => 'data berhasil dihapus',
            'data' => null
        ]);
    }


}
