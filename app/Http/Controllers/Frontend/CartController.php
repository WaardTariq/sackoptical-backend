<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart.index');
    }

    public function checkout()
    {
        if (count(session('cart', [])) == 0) {
            return redirect()->route('shop.index')->with('error', 'Your bag is empty.');
        }
        return view('frontend.cart.checkout');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'contact' => 'required|string',
            'delivery_method' => 'required|in:ship',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'payment_method' => 'required|in:stripe,cod',
            'prescription_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'prescription_doctor' => 'nullable|string|max:255',
            'prescription_date' => 'nullable|string',
            'prescription_time' => 'nullable|string',
        ]);

        $cart = session('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('shop.index')->with('error', 'Your bag is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $prescriptionPath = null;
        if ($request->hasFile('prescription_file')) {
            $prescriptionPath = $request->file('prescription_file')->store('prescriptions', 'public');
        }

        DB::transaction(function () use ($request, $cart, $subtotal, $prescriptionPath) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(str_replace('.', '', uniqid('', true))),
                'status' => 'pending',
                'payment_status' => $request->payment_method == 'stripe' ? 'paid' : 'unpaid',
                'payment_method' => $request->payment_method,
                'total' => $subtotal,
                'tax' => 0,
                'shipping_cost' => 0,
                'discount' => 0,
                'shipping_address' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->contact, // Store contact in email for compatibility
                    'address' => $request->address,
                    'apartment' => $request->apartment,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'country' => $request->country,
                    'delivery_method' => $request->delivery_method,
                ],
                'billing_address' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'address' => $request->address,
                ],
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'tax_amount' => 0,
                    'tax_rate' => 0,
                    'prescription_data' => [
                        'variant_name' => $item['variant_name'] ?? null,
                        'variant_id' => $item['variant_id'] ?? null,
                    ],
                    'prescription_file' => $prescriptionPath,
                    'prescription_doctor' => $request->prescription_doctor,
                    'prescription_date' => $request->prescription_date,
                    'prescription_time' => $request->prescription_time,
                ]);
            }
        });

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Thank you! Your order with prescription has been placed successfully.');
    }

    // Temporary basic implementation
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $variantId = $request->variant_id;
        $quantity = $request->quantity ?? 1;

        $cartKey = $variantId ? $productId . '-' . $variantId : $productId;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $product = \App\Models\Product::find($productId);
            $variant = $variantId ? \App\Models\ProductVariant::find($variantId) : null;

            $cart[$cartKey] = [
                'product_id' => $productId,
                'variant_id' => $variantId,
                'name' => $product->name,
                'price' => $variant ? $variant->price : $product->price,
                'image' => $product->primary_image,
                'quantity' => $quantity,
                'variant_name' => $variant ? $variant->variant_name : null,
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to bag!',
                'cart_count' => count($cart)
            ]);
        }

        if ($request->buy_now) {
            return redirect()->route('checkout');
        }

        return back()->with('success', 'Product added to bag!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Product removed from bag!');
    }
}
