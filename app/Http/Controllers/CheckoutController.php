<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get cart items for authenticated user
        $cart_items = Cart::with(['product'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cart_items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Please add items before checkout.');
        }

        // Calculate totals
        $subtotal = $cart_items->sum(function($item) {
            return ($item->unit_amount ?? 0) * ($item->quantity ?? 1);
        });

        $shipping = 0; // You can add shipping calculation logic
        $grand_total = $subtotal + $shipping;
        $cart_count = $cart_items->sum('quantity');

        return view('frontend.checkout.index', compact('cart_items', 'subtotal', 'shipping', 'grand_total', 'cart_count'));
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'street_address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:20'],
            'payment_method' => ['required', 'in:cash_on_delivery,stripe'],
            'order_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Get cart items
            $cart_items = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();

            if ($cart_items->isEmpty()) {
                return redirect()->route('cart.index')
                    ->with('error', 'Your cart is empty.');
            }

            // Calculate totals
            $subtotal = $cart_items->sum(function($item) {
                return ($item->unit_amount ?? 0) * ($item->quantity ?? 1);
            });

            $shipping = 0;
            $grand_total = $subtotal + $shipping;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'grand_total' => $grand_total,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method == 'cash_on_delivery' ? 'pending' : 'pending',
                'status' => 'new',
                'currency' => 'NPR',
                'shipping_amount' => $shipping,
                'shipping_method' => 'standard',
                'notes' => $request->order_notes,
            ]);

            // Create order items
            foreach ($cart_items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_amount' => $item->unit_amount,
                    'total_amount' => ($item->unit_amount ?? 0) * ($item->quantity ?? 1),
                ]);
            }

            // Create address
            Address::create([
                'order_id' => $order->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
            ]);

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // Redirect based on payment method
            if ($request->payment_method == 'stripe') {
                // Redirect to Stripe payment
                return redirect()->route('stripe.payment', ['order_id' => $order->id]);
            }

            // For COD, show success page
            return redirect()->route('checkout.success')
                ->with('success', 'Order placed successfully! Your order #' . $order->id . ' has been confirmed.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }

    public function success()
    {
        return view('frontend.checkout.success');
    }

    public function cancel()
    {
        return view('frontend.checkout.cancel');
    }
}
