@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Tambah Tryout Program</h1>

    <form action="{{ route('admin.tryout-programs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @include('admin.tryout-programs.partials.form')
        <div class="flex justify-end">
            <a href="{{ route('admin.tryout-programs.index') }}" class="px-6 py-3 border rounded mr-3">Batal</a>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
