<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(request $request)
    {
        $search = $request->get('search');

        $product_categories = Category::when($search, function ($query) use ($search) {
            return $query->where('category_name', 'like', '%' . $search . '%');
        })->paginate(3);
        return view('category.index', ['category' => $product_categories]);
    }
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {

        $rules = ['category_name' => 'required',];

        $messages = ['category_name.required' => 'Nama Kategori harus diisi.',];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('category.create'))
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('product_categories')->insert([
            'category_name' => $request->category_name,
        ]);

        return redirect('/category')->with("success", "Data Berhasil Ditambah");
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('category.edit', compact('category'));
    }

    public function update(Request $request)
    {

        $rules = ['category_name' => 'required',];

        $messages = ['category_name.required' => 'Nama Kategori harus diisi.',];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('products.edit', $request->id))
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('product_categories')->where('id', $request->id)->update([
            'category_name' => $request->category_name,
        ]);
        return redirect('/category')->with('success', 'Data Berhasil Diedit');
    }

    public function destroy($id)
    {
        DB::table('product_categories')->where('id', $id)->delete();
        return redirect('/category')->with('success', 'Data Berhasil Dihapus');
    }
}
