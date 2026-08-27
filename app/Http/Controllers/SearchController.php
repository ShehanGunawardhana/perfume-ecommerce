<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->get('q', '');

        $results = $term
            ? Perfume::where('is_active', true)
                ->where(function ($q) use ($term) {
                    $q->where('name', 'like', "%{$term}%")
                        ->orWhere('brand', 'like', "%{$term}%");
                })
                ->paginate(12)
            : collect();

        if ($request->wantsJson()) {
            $mapped = $term ? $results->getCollection()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'brand' => $p->brand,
                    'url' => route('shop.show', $p->slug),
                    'image' => $p->main_image ? asset('storage/' . $p->main_image) : asset('assets/images/perfumes/placeholder.jpg'),
                ];
            }) : [];

            return response()->json([
                'items' => $mapped,
                'total' => $term ? $results->total() : 0,
            ]);
        }

        return view('shop.search', compact('results', 'term'));
    }
}
