<div class="mb-4">
    <label class="block mb-1">Kode</label>
    <input type="text" name="code" value="{{ old('code', $bimbelProgram->code ?? '') }}" class="w-full border p-2 rounded">
    @error('code') <p class="text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block mb-1">Nama</label>
    <input type="text" name="name" value="{{ old('name', $bimbelProgram->name ?? '') }}" class="w-full border p-2 rounded">
    @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block mb-1">Kategori</label>
    <input type="text" name="category" value="{{ old('category', $bimbelProgram->category ?? '') }}" class="w-full border p-2 rounded">
    @error('category') <p class="text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block mb-1">Peserta</label>
    <input type="text" name="participants" value="{{ old('participants', $bimbelProgram->participants ?? '') }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block mb-1">Deskripsi</label>
    <textarea name="description" class="w-full border p-2 rounded">{{ old('description', $bimbelProgram->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block mb-1">Gambar</label>
    <input type="file" name="image" class="w-full border p-2 rounded">
    @if(!empty($bimbelProgram->image))
        <img src="{{ asset('storage/'.$bimbelProgram->image) }}" width="100" class="mt-2">
    @endif
</div>
