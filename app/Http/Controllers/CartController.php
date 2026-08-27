<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Perfume;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->currentCart();

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request, Perfume $perfume)
    {
        $cart = $this->currentCart();

        $item = $cart->items()->where('perfume_id', $perfume->id)->first();

        if ($item) {
            $item->increment('quantity', $request->integer('quantity', 1));
        } else {
            $cart->items()->create([
                'perfume_id' => $perfume->id,
                'quantity' => $request->integer('quantity', 1),
            ]);
        }

        return back()->with('success', 'Added to cart.');
    }

    public function update(Request $request, $itemId)
    {
        $cart = $this->currentCart();
        $item = $cart->items()->findOrFail($itemId);
        $item->update(['quantity' => max(1, (int) $request->input('quantity', 1))]);

        return back();
    }

    public function destroy($itemId)
    {
        $cart = $this->currentCart();
        $cart->items()->where('id', $itemId)->delete();

        return back()->with('success', 'Removed from cart.');
    }

    private function currentCart(): Cart
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }

        $sessionId = session()->getId();

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }
}
