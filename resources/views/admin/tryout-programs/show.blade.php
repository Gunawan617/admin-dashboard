@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">{{ $program->name }}</h1>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Code:</strong> {{ $program->code }}</p>
        <p><strong>Category:</strong> {{ $program->category }}</p>
        <p><strong>Participants:</strong> {{ $program->participants }}</p>
        <p><strong>Description:</strong> {{ $program->description }}</p>
        @if($program->image)
            <img src="{{ asset($program->image) }}" alt="image" class="mt-4 rounded-lg w-64">
        @endif
        <div class="mt-6">
            <a href="{{ route('admin.tryout-programs.index') }}" class="px-6 py-3 border rounded">Kembali</a>
        </div>
    </div>
</div>
@endsection
