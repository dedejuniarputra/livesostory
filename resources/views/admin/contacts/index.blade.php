@extends('admin.layout')
@section('header', 'Contact Messages')
@section('content')

<div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-dark-700">
                <th class="text-left px-6 py-3">Nama</th>
                <th class="text-left px-6 py-3">Email</th>
                <th class="text-left px-6 py-3">Pesan</th>
                <th class="text-left px-6 py-3">Tanggal</th>
                <th class="text-left px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-dark-800">
            @forelse($contacts as $contact)
                <tr class="hover:bg-dark-800/30 transition-colors {{ !$contact->is_read ? 'border-l-2 border-l-gold-400' : '' }}">
                    <td class="px-6 py-3 text-sm {{ !$contact->is_read ? 'text-white font-medium' : 'text-gray-400' }}">{{ $contact->name }}</td>
                    <td class="px-6 py-3 text-sm text-gray-400">{{ $contact->email }}</td>
                    <td class="px-6 py-3 text-sm text-gray-400 max-w-xs truncate">{{ $contact->message }}</td>
                    <td class="px-6 py-3 text-sm text-gray-500">{{ $contact->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-xs text-gray-400 hover:text-white transition-colors">Baca</a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-xs text-red-400 hover:text-red-300 transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada pesan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $contacts->links() }}</div>

@endsection
