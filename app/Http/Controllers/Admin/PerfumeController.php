<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PerfumeController extends Controller
{
    public function index()
    {
        $perfumes = Perfume::with('category')->latest()->paginate(15);

        return view('admin.perfumes.index', compact('perfumes'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.perfumes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('perfumes', 'public');
        }

        $perfume = Perfume::create($data);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $perfume->images()->create([
                    'image_path' => $image->store('perfumes/gallery', 'public')
                ]);
            }
        }

        return redirect()->route('admin.perfumes.index')->with('success', 'Perfume created.');
    }

    public function edit(Perfume $perfume)
    {
        $categories = Category::all();

        return view('admin.perfumes.edit', compact('perfume', 'categories'));
    }

    public function update(Request $request, Perfume $perfume)
    {
        $data = $this->validated($request);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('perfumes', 'public');
        }

        $perfume->update($data);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $perfume->images()->create([
                    'image_path' => $image->store('perfumes/gallery', 'public')
                ]);
            }
        }

        return redirect()->route('admin.perfumes.index')->with('success', 'Perfume updated.');
    }

    public function destroy(Perfume $perfume)
    {
        $perfume->delete();

        return back()->with('success', 'Perfume deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'gender' => 'required|in:men,women,unisex',
            'volume' => 'nullable|string|max:50',
            'fragrance_family' => 'nullable|string|max:100',
            'concentration' => 'nullable|string|max:100',
            'top_notes' => 'nullable|string',
            'middle_notes' => 'nullable|string',
            'base_notes' => 'nullable|string',
            'longevity' => 'nullable|string|max:100',
            'season' => 'nullable|string|max:100',
            'occasion' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'main_image' => 'nullable|image|max:4096',
            'gallery_images.*' => 'nullable|image|max:4096',
        ]);
    }
}
