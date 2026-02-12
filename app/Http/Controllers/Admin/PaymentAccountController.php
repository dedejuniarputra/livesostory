<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    public function index()
    {
        $accounts = PaymentAccount::all();
        return view('admin.payment-accounts.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
        ]);

        $validated['is_active'] = true;

        PaymentAccount::create($validated);

        return redirect()->route('admin.payment-accounts.index')->with('success', 'Rekening berhasil ditambahkan!');
    }

    public function edit(PaymentAccount $paymentAccount)
    {
        return view('admin.payment-accounts.edit', compact('paymentAccount'));
    }

    public function update(Request $request, PaymentAccount $paymentAccount)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $paymentAccount->update($validated);

        return redirect()->route('admin.payment-accounts.index')->with('success', 'Rekening berhasil diperbarui!');
    }

    public function destroy(PaymentAccount $paymentAccount)
    {
        $paymentAccount->delete();
        return redirect()->route('admin.payment-accounts.index')->with('success', 'Rekening berhasil dihapus!');
    }
}
