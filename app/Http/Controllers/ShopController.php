<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Perfume;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Perfume::query()->where('is_active', true)->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('fragrance_family')) {
            $query->where('fragrance_family', $request->fragrance_family);
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        match ($request->get('sort')) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'popular' => $query->orderBy('is_featured', 'desc'),
            default => $query->latest(),
        };

        $perfumes = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->get();

        return view('shop.index', compact('perfumes', 'categories'));
    }

    public function show(string $slug)
    {
        $perfume = Perfume::where('slug', $slug)->where('is_active', true)->with(['images', 'category'])->firstOrFail();

        $related = Perfume::where('category_id', $perfume->category_id)
            ->where('id', '!=', $perfume->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('perfume', 'related'));
    }
}
