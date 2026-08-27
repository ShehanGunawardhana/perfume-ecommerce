@csrf
<input type="text" name="name" placeholder="Name" value="{{ old('name', $perfume->name ?? '') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
<input type="text" name="brand" placeholder="Brand" value="{{ old('brand', $perfume->brand ?? '') }}" class="w-full border border-line bg-transparent px-4 py-3 text-sm">

<select name="category_id" required class="w-full border border-line bg-void px-4 py-3 text-sm">
    <option value="">Select Category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id', $perfume->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
    @endforeach
</select>

<textarea name="description" placeholder="Description" rows="4" class="w-full border border-line bg-transparent px-4 py-3 text-sm">{{ old('description', $perfume->description ?? '') }}</textarea>

<div class="grid grid-cols-2 gap-4">
    <input type="number" step="0.01" name="price" placeholder="Price" value="{{ old('price', $perfume->price ?? '') }}" required class="border border-line bg-transparent px-4 py-3 text-sm">
    <input type="number" step="0.01" name="discount_price" placeholder="Discount Price" value="{{ old('discount_price', $perfume->discount_price ?? '') }}" class="border border-line bg-transparent px-4 py-3 text-sm">
    <input type="number" name="stock" placeholder="Stock" value="{{ old('stock', $perfume->stock ?? 0) }}" required class="border border-line bg-transparent px-4 py-3 text-sm">
    <input type="text" name="volume" placeholder="Volume (e.g. 100ml)" value="{{ old('volume', $perfume->volume ?? '') }}" class="border border-line bg-transparent px-4 py-3 text-sm">
</div>

<select name="gender" class="w-full border border-line bg-void px-4 py-3 text-sm">
    @foreach (['unisex' => 'Unisex', 'men' => 'Men', 'women' => 'Women'] as $value => $label)
        <option value="{{ $value }}" {{ old('gender', $perfume->gender ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>

<div class="grid grid-cols-2 gap-4">
    <input type="text" name="fragrance_family" placeholder="Fragrance Family" value="{{ old('fragrance_family', $perfume->fragrance_family ?? '') }}" class="border border-line bg-transparent px-4 py-3 text-sm">
    <input type="text" name="concentration" placeholder="Concentration (EDP, EDT...)" value="{{ old('concentration', $perfume->concentration ?? '') }}" class="border border-line bg-transparent px-4 py-3 text-sm">
</div>

<input type="text" name="top_notes" placeholder="Top Notes" value="{{ old('top_notes', $perfume->top_notes ?? '') }}" class="w-full border border-line bg-transparent px-4 py-3 text-sm">
<input type="text" name="middle_notes" placeholder="Middle Notes" value="{{ old('middle_notes', $perfume->middle_notes ?? '') }}" class="w-full border border-line bg-transparent px-4 py-3 text-sm">
<input type="text" name="base_notes" placeholder="Base Notes" value="{{ old('base_notes', $perfume->base_notes ?? '') }}" class="w-full border border-line bg-transparent px-4 py-3 text-sm">

<input type="file" name="main_image" class="w-full border border-line bg-transparent px-4 py-3 text-sm">

<div class="flex gap-6 text-sm">
    <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $perfume->is_featured ?? false) ? 'checked' : '' }}> Featured</label>
    <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $perfume->is_active ?? true) ? 'checked' : '' }}> Active</label>
</div>
