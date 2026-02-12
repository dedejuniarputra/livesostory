@extends('admin.layout')
@section('header', 'Payment Accounts')
@section('content')

<!-- Add Form -->
<div class="max-w-2xl mb-8">
    <h3 class="text-sm font-medium mb-4">Tambah Rekening</h3>
    <form action="{{ route('admin.payment-accounts.store') }}" method="POST" class="bg-dark-800/50 border border-dark-700 p-6 rounded">
        @csrf
        <div class="grid md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Bank *</label>
                <input type="text" name="bank_name" required placeholder="e.g. Bank BCA" class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">No. Rekening *</label>
                <input type="text" name="account_number" required class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">A/N *</label>
                <input type="text" name="account_holder" required class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            </div>
        </div>
        <button type="submit" class="px-4 py-2.5 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Tambah</button>
    </form>
</div>

<!-- Accounts List -->
<div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-dark-700">
                <th class="text-left px-6 py-3">Bank</th>
                <th class="text-left px-6 py-3">No. Rekening</th>
                <th class="text-left px-6 py-3">Atas Nama</th>
                <th class="text-left px-6 py-3">Status</th>
                <th class="text-left px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-dark-800">
            @forelse($accounts as $account)
                <tr class="hover:bg-dark-800/30 transition-colors">
                    <td class="px-6 py-3 text-sm">{{ $account->bank_name }}</td>
                    <td class="px-6 py-3 text-sm font-mono">{{ $account->account_number }}</td>
                    <td class="px-6 py-3 text-sm text-gray-400">{{ $account->account_holder }}</td>
                    <td class="px-6 py-3">
                        @if($account->is_active)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500/20 text-green-400">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-500/20 text-gray-400">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 flex items-center gap-3">
                        <a href="{{ route('admin.payment-accounts.edit', $account) }}" class="text-xs text-gold-400 hover:text-gold-300 transition-colors">Edit</a>
                        <form action="{{ route('admin.payment-accounts.destroy', $account) }}" method="POST" onsubmit="return confirm('Hapus rekening ini?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-400 hover:text-red-300 transition-colors">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada rekening.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
