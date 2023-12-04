<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index(request $request)
    {
        $search = $request->input('search');

        $sales = Sales::join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('sales.*', 'customers.name')
            ->where(function ($query) use ($search) {
                $query->where('code_sale', 'like', '%' . $search . '%')
                    ->orWhere('trx_date', 'like', '%' . $search . '%')
                    ->orWhere('sub_amount', 'like', '%' . $search . '%')
                    ->orWhere('amount_total', 'like', '%' . $search . '%')
                    ->orWhere('total_products', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(4);

        return view('sales.index', ['sales' => $sales]);

    }

    public function create()
    {
        $customers = DB::table('customers')->get();
        return view('sales.create', ['customers' => $customers]);
    }

    public function store(request $request)
    {
        $rules = [
            'trx_date' => 'required|date',
            'sub_amount' => 'required|numeric',
            'amount_total' => 'required|numeric',
            'total_products' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
            'description' => 'required',
        ];

        $messages = [
            'trx_date.required' => 'Tanggal transaksi harus diisi.',
            'trx_date.date' => 'Format tanggal transaksi tidak valid.',
            'sub_amount.required' => 'Sub total harus diisi.',
            'sub_amount.numeric' => 'Sub total harus berupa angka.',
            'amount_total.required' => 'Total jumlah harus diisi.',
            'amount_total.numeric' => 'Total jumlah harus berupa angka.',
            'total_products.required' => 'Jumlah produk harus diisi.',
            'total_products.numeric' => 'Jumlah produk harus berupa angka.',
            'customer_id.required' => 'Pelanggan harus dipilih.',
            'customer_id.exists' => 'Pelanggan tidak valid.',
            'description.required' => 'Deskripsi penjualan harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('sales.create'))
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat kode pelanggan otomatis
        $latestCustomer = DB::table('sales')->latest('id')->first();
        $latestCode = ($latestCustomer) ? $latestCustomer->code_sale : 'S000';
        $nextNumber = (int) substr($latestCode, 1) + 1;
        $newCode = 'S' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        DB::table('sales')->insert([
            'code_sale' => $newCode,
            'trx_date' => $request->trx_date,
            'sub_amount' => $request->sub_amount,
            'amount_total' => $request->amount_total,
            'total_products' => $request->total_products,
            'customer_id' => $request->customer_id,
            'description' => $request->description,
        ]);

        return redirect('/sales')->with("success", "Data Berhasil Ditambah");
    }

    public function edit($id)
    {
        $sales = DB::table('sales')->where('id', $id)->first();
        $customers = DB::table('customers')->pluck('name', 'id');
        return view('sales.edit', compact('sales', 'customers'));
    }

    public function update(request $request)
    {
        $rules = [
            'trx_date' => 'required|date',
            'sub_amount' => 'required|numeric',
            'amount_total' => 'required|numeric',
            'total_products' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
            'description' => 'required',
        ];

        $messages = [
            'trx_date.required' => 'Tanggal transaksi harus diisi.',
            'trx_date.date' => 'Format tanggal transaksi tidak valid.',
            'sub_amount.required' => 'Sub total harus diisi.',
            'sub_amount.numeric' => 'Sub total harus berupa angka.',
            'amount_total.required' => 'Total jumlah harus diisi.',
            'amount_total.numeric' => 'Total jumlah harus berupa angka.',
            'total_products.required' => 'Jumlah produk harus diisi.',
            'total_products.numeric' => 'Jumlah produk harus berupa angka.',
            'customer_id.required' => 'Pelanggan harus dipilih.',
            'customer_id.exists' => 'Pelanggan tidak valid.',
            'description.required' => 'Deskripsi penjualan harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('sales.edit', ['id' => $request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('sales')->where('id', $request->id)->update([
            'trx_date' => $request->trx_date,
            'sub_amount' => $request->sub_amount,
            'amount_total' => $request->amount_total,
            'total_products' => $request->total_products,
            'customer_id' => $request->customer_id,
            'description' => $request->description,
        ]);

        return redirect('/sales')->with("success", "Data Berhasil Diubah");
    }

    public function destroy($id)
    {
        $sales = DB::table('sales')->where('id', $id)->first();

        // Pastikan sales ditemukan
        if (!$sales) {
            return redirect('/sales')->with('error', 'Penjualan tidak ditemukan');
        }

        DB::table('sales')->where('id', $id)->delete();
        return redirect('/sales')->with('success', 'Data Berhasil Dihapus');
    }
}
