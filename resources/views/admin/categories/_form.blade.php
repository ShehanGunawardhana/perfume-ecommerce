@if ($errors->any())
    <div class="mb-6 rounded border border-red-500 bg-red-500/10 p-4 text-sm text-red-500">
        <ul class="list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
<input type="text" name="name" placeholder="Name" value="{{ old('name', $category->name ?? '') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
<textarea name="description" placeholder="Description" rows="3" class="w-full border border-line bg-transparent px-4 py-3 text-sm">{{ old('description', $category->description ?? '') }}</textarea>
<input type="file" name="image" class="w-full border border-line bg-transparent px-4 py-3 text-sm">
<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}> Active</label>
