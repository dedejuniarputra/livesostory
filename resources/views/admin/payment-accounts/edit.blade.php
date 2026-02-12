@extends('admin.layout')
@section('header', 'Edit Payment Account')
@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.payment-accounts.update', $paymentAccount) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')
        
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Bank *</label>
            <input type="text" name="bank_name" value="{{ old('bank_name', $paymentAccount->bank_name) }}" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>

        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">No. Rekening *</label>
            <input type="text" name="account_number" value="{{ old('account_number', $paymentAccount->account_number) }}" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>

        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Atas Nama *</label>
            <input type="text" name="account_holder" value="{{ old('account_holder', $paymentAccount->account_holder) }}" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $paymentAccount->is_active ? 'checked' : '' }} class="rounded bg-dark-800 border-dark-600 text-gold-400 focus:ring-gold-400">
            <label for="is_active" class="text-sm text-gray-400">Active</label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update</button>
            <a href="{{ route('admin.payment-accounts.index') }}" class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
        </div>
    </form>
</div>

@endsection
