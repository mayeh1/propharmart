<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop')->with('info', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn ($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));

        return view('storefront.checkout', [
            'items' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $subtotal > 60 ? 0 : 6.99,
            'total' => $subtotal > 60 ? $subtotal : $subtotal + 6.99,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:50',
            'shipping_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop')->with('info', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn ($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));
        $shipping = $subtotal > 60 ? 0 : 6.99;
        $total = $subtotal + $shipping;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'PH-' . strtoupper(Str::random(8)),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'shipping_address' => $validated['shipping_address'],
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => ($item['price'] * $item['quantity']),
            ]);

            if ($product) {
                $product->stock = max(0, $product->stock - $item['quantity']);
                $product->save();
            }
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', $order)->with('success', 'Order placed successfully.');
    }

    public function success(Order $order)
    {
        return view('storefront.checkout-success', compact('order'));
    }
}
