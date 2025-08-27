@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto max-w-6xl">

    <!-- Notifikasi sukses -->
    @if(session('success'))
    <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg flex justify-between items-center">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="ml-4 text-green-700 hover:text-green-900">&times;</button>
    </div>
    @endif

    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Daftar Team Member</h1>
            <p class="text-gray-600">Kelola semua anggota tim yang sudah ditambahkan</p>
        </div>
        <a href="{{ route('admin.team-members.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition-all">
            + Tambah Member
        </a>
    </div>

    <!-- Tabel Team Member -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Foto</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Nama</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($teamMembers as $member)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($member->src)
                            <img src="{{ asset('storage/' . $member->src) }}" alt="foto {{ $member->name }}" class="h-16 w-16 object-cover rounded-full shadow">
                        @else
                            <span class="text-gray-400 italic">No Image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $member->name }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.team-members.edit', $member->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.team-members.destroy', $member->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus member ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 italic">
                        Belum ada anggota tim ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
