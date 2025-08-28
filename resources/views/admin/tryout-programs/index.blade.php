@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto max-w-6xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Tryout Program</h1>
        <a href="{{ route('admin.tryout-programs.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Tambah Tryout</a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Code</th>
                    <th class="px-6 py-3 border-b">Name</th>
                    <th class="px-6 py-3 border-b">Category</th>
                    <th class="px-6 py-3 border-b">Participants</th>
                    <th class="px-6 py-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programs as $program)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 border-b">{{ $program->code }}</td>
                    <td class="px-6 py-4 border-b font-medium">{{ $program->name }}</td>
                    <td class="px-6 py-4 border-b">{{ $program->category }}</td>
                    <td class="px-6 py-4 border-b">{{ $program->participants }}</td>
                    <td class="px-6 py-4 border-b space-x-2">
                        <a href="{{ route('admin.tryout-programs.show', $program->id) }}" class="px-3 py-2 bg-green-500 text-white rounded text-sm">Detail</a>
                        <a href="{{ route('admin.tryout-programs.edit', $program->id) }}" class="px-3 py-2 bg-yellow-500 text-white rounded text-sm">Edit</a>
                        <form action="{{ route('admin.tryout-programs.destroy', $program->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus program ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
