<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
{
    $cart = Session::get('cart', []);

    $cartTotal = $this->getCartTotal();
    $cartCount = $this->getCartCount();

    $shippingAmount = 0;
    $taxRate = 0.10;
    $taxes = $cartTotal * $taxRate;
    $grandTotal = $cartTotal + $taxes + $shippingAmount;

    return view('frontend.cart.cart_page', compact(
        'cart',
        'cartTotal',
        'cartCount',
        'taxes',
        'shippingAmount',
        'grandTotal'
    ));
}
public function clear()
{
    session()->forget('cart');

    return redirect()
        ->route('cart.index')
        ->with('success', 'Cart cleared successfully.');
}

    public function add(Request $request)
    {

        // Log for debugging
        \Log::info('Cart add called', $request->all());

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        try {
            $product = Product::findOrFail($productId);

            // Get cart from session
            $cart = Session::get('cart', []);

            // Check if product already in cart
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => isset($product->image[0]) ? $product->image[0] : null,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity
                ];
            }

            // Update total
            $cart[$productId]['total'] = $cart[$productId]['price'] * $cart[$productId]['quantity'];

            Session::put('cart', $cart);

            // Calculate cart count
            $cartCount = $this->getCartCount();

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $cartCount,
                'cart_total' => $this->getCartTotal()
            ]);

        } catch (\Exception $e) {
            \Log::error('Cart add error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error adding product to cart'
            ], 500);
        }
    }

    private function getCartCount()
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    private function getCartTotal()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['total'];
        }
        return $total;
    }
    public function remove(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer',
    ]);

    $cart = Session::get('cart', []);

    if (isset($cart[$request->product_id])) {
        unset($cart[$request->product_id]);
        Session::put('cart', $cart);
    }

    return redirect()
        ->route('cart.index')
        ->with('success', 'Product removed from cart successfully.');
}
}
