<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        // Get cart items from database
        $cart_items = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $cartTotal = $cart_items->sum(function($item) {
            return $item->unit_amount * $item->quantity;
        });

        $cartCount = $cart_items->sum('quantity');

        $shippingAmount = 0;
        $taxRate = 0.10;
        $taxes = $cartTotal * $taxRate;
        $grandTotal = $cartTotal + $taxes + $shippingAmount;

        return view('frontend.cart.cart_page', compact(
            'cart_items',
            'cartTotal',
            'cartCount',
            'taxes',
            'shippingAmount',
            'grandTotal'
        ));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $product = Product::findOrFail($request->product_id);

            // Check if product is in stock
            if (!$product->in_stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is out of stock'
                ], 400);
            }

            // Check if product already in cart
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                // Update existing cart item
                $cartItem->quantity += $request->quantity;
                $cartItem->total_amount = $cartItem->quantity * $cartItem->unit_amount;
                $cartItem->save();
            } else {
                // Create new cart item
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'unit_amount' => $product->price,
                    'total_amount' => $request->quantity * $product->price,
                ]);
            }

            // Calculate cart count
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            $cartTotal = Cart::where('user_id', Auth::id())
                ->sum('total_amount');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $cartCount,
                'cart_total' => $cartTotal
            ]);

        } catch (\Exception $e) {
            \Log::error('Cart add error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error adding product to cart'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => ['required', 'exists:carts,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $cartItem = Cart::where('id', $request->cart_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $cartItem->quantity = $request->quantity;
            $cartItem->total_amount = $cartItem->quantity * $cartItem->unit_amount;
            $cartItem->save();

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating cart'
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->delete();

            return redirect()
                ->route('cart.index')
                ->with('success', 'Product removed from cart successfully.');

        } catch (\Exception $e) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Error removing product from cart');
        }
    }

    public function clear()
    {
        try {
            Cart::where('user_id', Auth::id())->delete();

            return redirect()
                ->route('cart.index')
                ->with('success', 'Cart cleared successfully.');

        } catch (\Exception $e) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Error clearing cart');
        }
    }
}
