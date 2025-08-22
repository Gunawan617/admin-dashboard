@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">User Management</h1>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

<table class="table-auto w-full mt-4 bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Role</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $user->name }}</td>
            <td class="px-4 py-2">{{ $user->email }}</td>
            <td class="px-4 py-2">{{ $user->role }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit Role</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
