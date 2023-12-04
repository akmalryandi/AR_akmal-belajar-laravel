<?php

namespace App\Http\Controllers;

use App\Models\SalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesDetailsController extends Controller
{
    public function index(request $request)
    {
        $search = $request->input('search');

        $salesDetails = SalesDetail::join('sales', 'sales_details.sales_id', '=', 'sales.id')
            ->join('products', 'sales_details.product_id', '=', 'products.id')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('sales_details.*', 'sales.code_sale', 'sales.trx_date', 'sales.sub_amount', 'sales.amount_total', 'sales.total_products as total_sales_products', 'products.product_name', 'sales.description', 'customers.name','products.description')
            ->where(function ($query) use ($search) {
                $query->where('sales.code_sale', 'like', '%' . $search . '%')
                    ->orWhere('sales.trx_date', 'like', '%' . $search . '%')
                    ->orWhere('sales.sub_amount', 'like', '%' . $search . '%')
                    ->orWhere('sales.amount_total', 'like', '%' . $search . '%')
                    ->orWhere('sales.total_products', 'like', '%' . $search . '%')
                    ->orWhere('products.description', 'like', '%' . $search . '%')
                    ->orWhere('products.product_name', 'like', '%' . $search . '%')
                    ->orWhere('sales_details.quantity', 'like', '%' . $search . '%')
                    ->orWhere('customers.name', 'like', '%' . $search . '%');


            })
            ->orderBy('sales_details.id', 'asc')
            ->paginate(4);

        return view('sales-details.index', ['salesDetails' => $salesDetails]);

    }

    public function create()
    {
        $sales = DB::table('sales')->get();
        $products = DB::table('products')->get();
        return view('sales-details.create', ['sales' => $sales, 'products' => $products]);
    }

    public function store(request $request)
    {
        $rules = [
            'sales_id' => 'required|exists:sales,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
        ];

        $messages = [
            'sales_id.required' => 'Penjualan harus dipilih.',
            'sales_id.exists' => 'Penjualan tidak valid.',
            'product_id.required' => 'Produk harus dipilih.',
            'product_id.exists' => 'Produk tidak valid.',
            'quantity.required' => 'Jumlah harus diisi.',
            'quantity.numeric' => 'Jumlah harus berupa angka.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('salesdetails.create')
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('sales_details')->insert([
            'sales_id' => $request->sales_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect('salesdetail')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
           $sales_detail = DB::table('sales_details')->where('id', $id)->first();
           $sales = DB::table('sales')->pluck('code_sale', 'id');
           $products = DB::table('products')->pluck('product_name', 'id');

           return view('sales-details.edit', compact('sales_detail', 'sales', 'products'));
    }

    public function update(request $request)
    {
        $rules = [
            'sales_id' => 'required|exists:sales,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
        ];

        $messages = [
            'sales_id.required' => 'Penjualan harus dipilih.',
            'sales_id.exists' => 'Penjualan tidak valid.',
            'product_id.required' => 'Produk harus dipilih.',
            'product_id.exists' => 'Produk tidak valid.',
            'quantity.required' => 'Jumlah harus diisi.',
            'quantity.numeric' => 'Jumlah harus berupa angka.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('salesdetail.edit', ['id' => $request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('sales_details')->where('id', $request->id)->update([
            'sales_id' => $request->sales_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect('salesdetail')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $sales_detail = DB::table('sales_details')->where('id', $id)->first();

        // Pastikan sales ditemukan
        if (!$sales_detail) {
            return redirect('salesdetail')->with('error', 'Penjualan tidak ditemukan');
        }

        DB::table('sales_details')->where('id', $id)->delete();
        return redirect('salesdetail')->with('success', 'Data Berhasil Dihapus');
    }
}
