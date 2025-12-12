<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $tax = $total * 0.05;
        $grandTotal = $total + $tax;

        return view('pages.cart', compact('cart', 'total', 'tax', 'grandTotal'));
    }

    public function addToCart(Request $request, $type, $id)
    {
        $item = null;
        if ($type === 'product') {
            $item = Product::findOrFail($id);
        } elseif ($type === 'service') {
            $item = Service::findOrFail($id);
        }

        if (!$item) {
            return redirect()->back()->with('error', 'Item not found');
        }

        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);
        $cartKey = $type . '_' . $id;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $image = null;
            if ($type === 'product' && $item->images && count($item->images) > 0) {
                $image = $item->images[0];
            } elseif ($type === 'service') {
                $image = $item->icon;
            }

            $cart[$cartKey] = [
                "name" => ($type === 'product' ? $item->name : $item->title),
                "quantity" => $quantity,
                "price" => $item->price,
                "image" => $image,
                "model_id" => $id,
                "type" => $type
            ];
        }

        session()->put('cart', $cart);

        // Calculate total items
        $totalItems = array_sum(array_column($cart, 'quantity'));

        if ($request->ajax()) {
            $cartHtml = view('partials.cart-sidebar-content', ['addedSuccess' => true])->render();
            return response()->json([
                'success' => true,
                'totalItems' => $totalItems,
                'html' => $cartHtml
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            $subtotal = $cart[$request->id]["quantity"] * $cart[$request->id]["price"];

            $total = 0;
            foreach ($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }

            $tax = $total * 0.05;
            $grandTotal = $total + $tax;

            return response()->json([
                'success' => true,
                'subtotal' => $subtotal,
                'total' => $total,
                'tax' => number_format($tax, 2),
                'grandTotal' => number_format($grandTotal, 2)
            ]);
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            $total = 0;
            foreach ($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }

            $tax = $total * 0.05;
            $grandTotal = $total + $tax;

            $totalItems = array_sum(array_column($cart, 'quantity'));
            $cartHtml = view('partials.cart-sidebar-content')->render();

            return response()->json([
                'success' => true,
                'total' => $total,
                'tax' => number_format($tax, 2),
                'grandTotal' => number_format($grandTotal, 2),
                'totalItems' => $totalItems,
                'html' => $cartHtml
            ]);
        }
    }
}
