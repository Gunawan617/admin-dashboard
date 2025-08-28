<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div>
        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Code<span class="text-red-500">*</span></label>
        <input type="text" id="code" name="code" value="{{ old('code', $program->code ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200" required>
        @error('code')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name<span class="text-red-500">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $program->name ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200" required>
        @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category<span class="text-red-500">*</span></label>
        <input type="text" id="category" name="category" value="{{ old('category', $program->category ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200" required>
        @error('category')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="participants" class="block text-sm font-medium text-gray-700 mb-1">Participants</label>
        <input type="number" id="participants" name="participants" min="0" value="{{ old('participants', $program->participants ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200">
        @error('participants')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
        <input type="file" id="image" name="image" accept="image/*" class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200">
        @error('image')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
        @if(!empty($program->image))
            <div class="mt-3">
                <p class="text-sm text-gray-600 mb-1">Current image:</p>
                <img src="{{ asset($program->image) }}" alt="current image" class="h-24 rounded">
            </div>
        @endif
    </div>

    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea id="description" name="description" rows="4" class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200">{{ old('description', $program->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>