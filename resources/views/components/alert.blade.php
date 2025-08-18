@props(['type', 'message'])

@php
    $bg = match($type) {
        'success' => 'bg-green-200 text-green-800',
        'error' => 'bg-red-200 text-red-800',
        default => 'bg-gray-200 text-gray-800'
    };
@endphp

<div class="p-3 rounded {{ $bg }} mb-4">
    {{ $message }}
</div>
