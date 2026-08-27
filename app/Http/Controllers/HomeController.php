<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Perfume;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPerfumes = Perfume::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::query()
            ->where('is_active', true)
            ->take(6)
            ->get();

        return view('home', compact('featuredPerfumes', 'categories'));
    }
}
