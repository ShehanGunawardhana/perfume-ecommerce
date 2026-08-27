@csrf
<input type="text" name="name" placeholder="Name" value="{{ old('name', $category->name ?? '') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
<textarea name="description" placeholder="Description" rows="3" class="w-full border border-line bg-transparent px-4 py-3 text-sm">{{ old('description', $category->description ?? '') }}</textarea>
<input type="file" name="image" class="w-full border border-line bg-transparent px-4 py-3 text-sm">
<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}> Active</label>
