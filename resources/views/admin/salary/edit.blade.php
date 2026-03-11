@extends('admin.layout')
@section('header', 'Edit Pembayaran Gaji')
@section('content')

    <div class="max-w-lg mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.salary.index') }}" class="text-gray-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-white font-semibold text-lg leading-none">Edit Pembayaran Gaji</h2>
                <p class="text-gray-500 text-xs mt-0.5">Perbarui data pembayaran gaji</p>
            </div>
        </div>

        <div class="bg-dark-800/50 border border-dark-700 rounded-xl p-6">
            <form action="{{ route('admin.salary.update', $salary) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama Anggota --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Nama Anggota Tim <span class="text-red-400">*</span>
                    </label>
                    <select name="team_member_id" required
                        class="w-full bg-dark-900 border border-dark-600 text-white text-sm rounded px-4 py-2.5 focus:outline-none focus:border-gold-400/50 transition-colors @error('team_member_id') border-red-500/50 @enderror">
                        <option value="" disabled>-- Pilih Anggota Tim --</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('team_member_id', $salary->team_member_id) == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('team_member_id')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Tanggal <span class="text-red-400">*</span>
                    </label>
                    <input type="date" name="start_date"
                        value="{{ old('start_date', $salary->start_date->format('Y-m-d')) }}" required
                        class="w-full bg-dark-900 border border-dark-600 text-white text-sm rounded px-4 py-2.5 focus:outline-none focus:border-gold-400/50 transition-colors [color-scheme:dark] @error('start_date') border-red-500/50 @enderror">
                    @error('start_date')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Job --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Job / Pekerjaan <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="job_description" value="{{ old('job_description', $salary->job_description) }}"
                        required placeholder="Contoh: Wedding Shoot, Maternity, dll."
                        class="w-full bg-dark-900 border border-dark-600 text-white text-sm rounded px-4 py-2.5 placeholder-gray-600 focus:outline-none focus:border-gold-400/50 transition-colors @error('job_description') border-red-500/50 @enderror">
                    @error('job_description')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Total Pembayaran --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Total Pembayaran <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-500 font-medium select-none">Rp</span>
                        <input type="text" id="total_amount_display" 
                            value="{{ old('total_amount', $salary->total_amount) ? number_format(old('total_amount', $salary->total_amount), 0, ',', '.') : '' }}"
                            placeholder="0"
                            class="w-full bg-dark-900 border border-dark-600 text-white text-sm rounded pl-10 pr-4 py-2.5 placeholder-gray-600 focus:outline-none focus:border-gold-400/50 transition-colors">
                        <input type="hidden" name="total_amount" id="total_amount" value="{{ old('total_amount', (int)$salary->total_amount) }}">
                    </div>
                    @error('total_amount')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="px-6 py-2.5 bg-gold-400 text-dark-950 text-xs font-semibold uppercase tracking-wider rounded hover:bg-gold-300 transition-colors">
                        Perbarui
                    </button>
                    <a href="{{ route('admin.salary.index') }}"
                        class="px-6 py-2.5 border border-dark-600 text-gray-400 text-xs font-semibold uppercase tracking-wider rounded hover:text-white hover:border-dark-500 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const displayInput = document.getElementById('total_amount_display');
            const hiddenInput = document.getElementById('total_amount');

            const formatNumber = (num) => {
                return num.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            };

            displayInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, "");
                hiddenInput.value = value;
                e.target.value = value ? formatNumber(value) : "";
            });
        });
    </script>
@endpush
@endsection