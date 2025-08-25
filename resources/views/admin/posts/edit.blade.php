@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Post</h1>

@if($errors->any())
    <x-alert type="error" :message="$errors->first()" />
@endif

<form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
    @csrf
    @method('PUT')
    <x-form-input label="Title" name="title" type="text" :value="$post->title" />
    <x-form-input label="Summary" name="summary" type="text" :value="$post->summary" />
        <div class="mb-4">
            <label class="block mb-1">Content</label>
            <textarea name="content" class="w-full border px-2 py-1 rounded">{{ $post->content }}</textarea>
        </div>
    <div class="mb-4">
        <label class="block mb-1">Image</label>
        <input type="file" name="image" class="w-full">
        @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" class="w-24 mt-2">
        @endif
    </div>
    <x-form-input label="Meta Title" name="meta_title" type="text" :value="$post->meta_title" />
    <x-form-input label="Meta Description" name="meta_description" type="text" :value="$post->meta_description" />
    <x-form-input label="Meta Keywords" name="meta_keywords" type="text" :value="$post->meta_keywords" />
    <x-form-input label="Canonical URL" name="canonical_url" type="text" :value="$post->canonical_url" />
    <div class="mb-4">
        <label class="block mb-1">Published At</label>
        <input type="datetime-local" name="published_at" class="w-full border px-2 py-1 rounded" value="{{ $post->published_at ? date('Y-m-d\TH:i', strtotime($post->published_at)) : '' }}">
    </div>
    <div class="mb-4">
        <label class="block mb-1">Status</label>
        <select name="status" class="w-full border px-2 py-1 rounded">
            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
            <option value="archived" {{ $post->status == 'archived' ? 'selected' : '' }}>Archived</option>
        </select>
    </div>
    <x-form-input label="Author" name="author" type="text" :value="$post->author" />
    <x-form-input label="Category" name="category" type="text" :value="$post->category" />
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
</form>
@endsection
