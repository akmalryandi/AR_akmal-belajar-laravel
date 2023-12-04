<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{

    public function index(request $request)
    {
        $search = $request->input('search');

        $customers = Customer::where(function ($query) use ($search) {
            $query->where('code_customer', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('phone_number', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(4);

        return view('customers.index', ['customers' => $customers]);
    }

    public function create()
    {
        $customers = Customer::all();
        return view('customers.create', ['customers' => $customers]);
    }

    public function store(request $request)
    {
        $rules = [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama pelanggan harus diisi.',
            'phone_number.required' => 'Nomor telepon pelanggan harus diisi.',
            'email.required' => 'Email pelanggan harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'address.required' => 'Alamat pelanggan harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('customers.create'))
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat kode pelanggan otomatis
        $latestCustomer = DB::table('customers')->latest('id')->first();
        $latestCode = ($latestCustomer) ? $latestCustomer->code_customer : 'C000';
        $nextNumber = (int) substr($latestCode, 1) + 1;
        $newCode = 'C' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        DB::table('customers')->insert([
            'code_customer' => $newCode,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect('/customers')->with("success", "Data Berhasil Ditambah");
    }

    public function edit($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        return view('customers.edit', ['customer' => $customer]);
    }

    public function update(request $request)
    {
        $rules = [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama pelanggan harus diisi.',
            'phone_number.required' => 'Nomor telepon pelanggan harus diisi.',
            'email.required' => 'Email pelanggan harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'address.required' => 'Alamat pelanggan harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('customers.edit', ['id' => $request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('customers')->where('id', $request->id)->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect('/customers')->with("success", "Data Berhasil Diperbarui");
    }

    public function destroy($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();

        // Pastikan pelanggan ditemukan
        if (!$customer) {
            return redirect('/customers')->with('error', 'Pelanggan tidak ditemukan');
        }

        DB::table('customers')->where('id', $id)->delete();
        return redirect('/customers')->with('success', 'Data Berhasil Dihapus');
    }
}
