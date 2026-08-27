<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:30',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'nullable|string|max:20',
        ]);

        $cart = Cart::with('items.perfume')->firstOrCreate(['user_id' => Auth::id()]);

        if ($cart->items->isEmpty()) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        $order = DB::transaction(function () use ($data, $cart) {
            $order = Order::create([
                ...$data,
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total' => $cart->total,
                'status' => 'pending',
                'payment_method' => 'cod',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'perfume_id' => $item->perfume_id,
                    'perfume_name' => $item->perfume->name,
                    'quantity' => $item->quantity,
                    'price' => $item->perfume->display_price,
                    'subtotal' => $item->subtotal,
                ]);

                $item->perfume->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully.');
    }
}
