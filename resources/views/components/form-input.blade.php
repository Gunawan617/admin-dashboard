@props(['label', 'name', 'type' => 'text', 'value' => ''])

<div class="mb-4">
    <label class="block mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="w-full border px-2 py-1 rounded">
</div>
