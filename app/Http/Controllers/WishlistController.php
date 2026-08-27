<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $items = Wishlist::where('user_id', auth()->id())->with('perfume')->get();

        return view('wishlist.index', compact('items'));
    }

    public function store(Perfume $perfume)
    {
        Wishlist::firstOrCreate(['user_id' => auth()->id(), 'perfume_id' => $perfume->id]);

        return back()->with('success', 'Added to wishlist.');
    }

    public function destroy(Perfume $perfume)
    {
        Wishlist::where('user_id', auth()->id())->where('perfume_id', $perfume->id)->delete();

        return back()->with('success', 'Removed from wishlist.');
    }
}
