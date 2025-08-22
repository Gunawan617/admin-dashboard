@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit User Role</h1>

@if($errors->any())
    <x-alert type="error" :message="$errors->first()" />
@endif

<form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white p-4 shadow rounded w-96">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1">Name</label>
        <input type="text" value="{{ $user->name }}" class="w-full border px-2 py-1 rounded bg-gray-100" disabled>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input type="text" value="{{ $user->email }}" class="w-full border px-2 py-1 rounded bg-gray-100" disabled>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Role</label>
        <select name="role" class="w-full border px-2 py-1 rounded">
            <option value="user" @if($user->role=='user') selected @endif>User</option>
            <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
        </select>
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update Role</button>
</form>
@endsection
