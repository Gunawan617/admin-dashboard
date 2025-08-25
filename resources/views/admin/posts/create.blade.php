@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Post</h1>

@if($errors->any())
    <x-alert type="error" :message="$errors->first()" />
@endif

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
    @csrf
    <x-form-input label="Title" name="title" type="text" :value="old('title')" />
    <x-form-input label="Summary" name="summary" type="text" :value="old('summary')" />
    <x-form-input label="Meta Title" name="meta_title" type="text" :value="old('meta_title')" />
    <div class="mb-4">
        <label class="block mb-1">Meta Description</label>
        <textarea name="meta_description" class="w-full border px-2 py-1 rounded">{{ old('meta_description') }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Meta Keywords</label>
        <textarea name="meta_keywords" class="w-full border px-2 py-1 rounded">{{ old('meta_keywords') }}</textarea>
    </div>
    <x-form-input label="Canonical URL" name="canonical_url" type="text" :value="old('canonical_url')" />
    <x-form-input label="Published At" name="published_at" type="datetime-local" :value="old('published_at')" />
    <x-form-input label="Author" name="author" type="text" :value="old('author')" />
    <x-form-input label="Category" name="category" type="text" :value="old('category')" />
    <div class="mb-4">
        <label class="block mb-1">Content</label>
        <textarea name="content" class="w-full border px-2 py-1 rounded">{{ old('content') }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Image</label>
        <input type="file" name="image" class="w-full">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
</form>
@endsection
