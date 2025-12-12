<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('pages.checkout', [
            'cart' => $cart,
            'subtotal' => $total,
            'tax' => $total * 0.05,
            'grandTotal' => $total * 1.05
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
        ]);

        $cart = session()->get('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $tax = $total * 0.05;
        $grandTotal = $total + $tax;

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id() ?? null, // Nullable for guest
                'customer_name' => $request->first_name . ' ' . $request->last_name,
                'customer_email' => $request->email,
                'customer_address' => json_encode([
                    'address' => $request->address,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'country' => $request->country ?? 'N/A'
                ]),
                'total_amount' => $grandTotal,
                'tax_amount' => $tax,
                'status' => 'pending',
            ]);

            foreach ($cart as $id => $details) {
                $productId = $id;
                // Handle service IDs which are prefixed with 'service_'
                // Handle prefixes
                if (str_contains($id, 'service_')) {
                    $productId = (int) str_replace('service_', '', $id);
                } elseif (str_contains($id, 'product_')) {
                    $productId = (int) str_replace('product_', '', $id);
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('thankyou', ['order' => $order->id]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error processing order: ' . $e->getMessage());
        }
    }

    public function thankyou(Order $order)
    {
        return view('pages.thankyou', compact('order'));
    }
}
