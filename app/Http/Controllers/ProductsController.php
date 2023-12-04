<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(request $request)
    {
        $search = $request->input('search');

        $products = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name')
            ->where(function ($query) use ($search) {
                $query->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('product_code', 'like', '%' . $search . '%')
                    ->orWhere('category_name', 'like', '%' . $search . '%')
                    ->orWhere('stock', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(3);
        return view('products.index', ['products' => $products]);
    }
    public function create()
    {
        $categories = DB::table('product_categories')->get();
        return view('products.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {

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

        // Upload file
        $imagePaths = [];
        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $filename);
                $imagePaths[] = 'uploads/' . $filename;
            }
        }

        DB::table('products')->insert([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_code' => $request->product_code,
            'category_id' => $request->category,
            'image' => json_encode($imagePaths),
        ]);

        return redirect('/products')->with("success", "Data Berhasil Ditambah");
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('product_categories')->pluck('category_name', 'id');
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request)
    {

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

        // Ambil data produk berdasarkan ID
        $product = DB::table('products')->where('id', $request->id)->first();

        // Pastikan produk ditemukan
        if (!$product) {
            return redirect('/products')->with('error', 'Produk tidak ditemukan');
        }

        // Upload file
        $imagePaths = [];
        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $filename);

                // Hapus gambar lama jika ada
                if ($product->image) {
                    foreach (json_decode($product->image) as $oldImage) {
                        $oldImagePath = public_path($oldImage);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }

                $imagePaths[] = 'uploads/' . $filename;
            }
        }

        DB::table('products')->where('id', $request->id)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_code' => $request->product_code,
            'category_id' => $request->category,
            'image' => json_encode($imagePaths),

        ]);
        return redirect('/products')->with('success', 'Data Berhasil Diedit');
    }

    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        // Pastikan produk ditemukan
        if (!$product) {
            return redirect('/products')->with('error', 'Produk tidak ditemukan');
        }

        // Hapus file gambar terkait dari penyimpanan
        if ($product->image) {
            foreach (json_decode($product->image) as $image) {
                Storage::delete($image);
                unlink(public_path($image));
            }
        }

        // Hapus data produk dari tabel
        DB::table('products')->where('id', $id)->delete();
        return redirect('/products')->with('success', 'Data Berhasil Dihapus');
    }

}
