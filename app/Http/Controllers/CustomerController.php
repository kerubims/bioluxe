<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::when(request('search'), function($q) {
            $search = request('search');
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->validated());
        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->sales()->count() > 0) {
            return redirect()->route('customers.index')->with('error', 'Customer tidak bisa dihapus karena memiliki riwayat transaksi.');
        }
        
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus.');
    }
}
