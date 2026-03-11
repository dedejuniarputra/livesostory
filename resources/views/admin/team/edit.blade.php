@extends('admin.layout')
@section('header', 'Edit Anggota Tim')
@section('content')

    <div class="max-w-lg mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.team.index') }}" class="text-gray-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-white font-semibold text-lg leading-none">Edit Anggota Tim</h2>
                <p class="text-gray-500 text-xs mt-0.5">Perbarui data {{ $team->name }}</p>
            </div>
        </div>

        <div class="bg-dark-800/50 border border-dark-700 rounded-xl p-6">
            <form action="{{ route('admin.team.update', $team) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Nama <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $team->name) }}" required
                        placeholder="Masukkan nama anggota tim"
                        class="w-full bg-dark-900 border border-dark-600 text-white text-sm rounded px-4 py-2.5 placeholder-gray-600 focus:outline-none focus:border-gold-400/50 transition-colors @error('name') border-red-500/50 @enderror">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role (Read Only) --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Role
                    </label>
                    <div
                        class="w-full bg-dark-900/50 border border-dark-700 text-gray-500 text-sm rounded px-4 py-2.5 flex items-center gap-2">
                        <span
                            class="px-2.5 py-0.5 text-[10px] uppercase font-bold tracking-widest bg-gold-400/10 text-gold-400 border border-gold-400/20 rounded-full">Team</span>
                        <span class="text-xs text-gray-600">Ditetapkan otomatis</span>
                    </div>
                </div>



                {{-- Rekening --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Rekening Bank
                    </label>
                    <input type="text" name="bank_account" value="{{ old('bank_account', $team->bank_account) }}"
                        placeholder="Contoh: BCA 123456789 a.n Nama"
                        class="w-full bg-dark-900 border border-dark-600 text-white text-sm rounded px-4 py-2.5 placeholder-gray-600 focus:outline-none focus:border-gold-400/50 transition-colors @error('bank_account') border-red-500/50 @enderror">
                    @error('bank_account')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="px-6 py-2.5 bg-gold-400 text-dark-950 text-xs font-semibold uppercase tracking-wider rounded hover:bg-gold-300 transition-colors">
                        Perbarui
                    </button>
                    <a href="{{ route('admin.team.index') }}"
                        class="px-6 py-2.5 border border-dark-600 text-gray-400 text-xs font-semibold uppercase tracking-wider rounded hover:text-white hover:border-dark-500 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection