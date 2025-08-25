@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Posts</h1>

<a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Post</a>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

<table class="table-auto w-full mt-4 bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Slug</th>
            <th class="px-4 py-2">Summary</th>
            <th class="px-4 py-2">Author</th>
            <th class="px-4 py-2">Category</th>
            <th class="px-4 py-2">Image</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $post->title }}</td>
            <td class="px-4 py-2">{{ $post->slug }}</td>
            <td class="px-4 py-2">{{ $post->summary }}</td>
            <td class="px-4 py-2">{{ $post->author }}</td>
            <td class="px-4 py-2">{{ $post->category }}</td>
            <td class="px-4 py-2">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="w-20">
                @endif
            </td>
            <td class="px-4 py-2 flex gap-2">
                <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $posts->links() }}
@endsection
