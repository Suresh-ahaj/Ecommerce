<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('orders') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Orders
            </a>
            <span class="text-gray-300 dark:text-gray-600">|</span>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Order Details</h1>
        </div>

        @php
            $statusColors = [
                'pending' => 'bg-yellow-500',
                'processing' => 'bg-blue-500',
                'shipped' => 'bg-purple-500',
                'delivered' => 'bg-green-500',
                'cancelled' => 'bg-red-500',
            ];
            $paymentColors = [
                'pending' => 'bg-yellow-500',
                'paid' => 'bg-green-500',
                'failed' => 'bg-red-500',
                'refunded' => 'bg-orange-500',
            ];
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Info Card -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                                    Order #{{ $order->order_number }}
                                </h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Placed on {{ $order->created_at->format('F d, Y h:i A') }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white {{ $statusColors[$order->status] ?? 'bg-gray-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white/30 mr-1.5"></span>
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white {{ $paymentColors[$order->payment_status] ?? 'bg-gray-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white/30 mr-1.5"></span>
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 dark:text-white mb-4">Items</h3>
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                                <div class="flex-shrink-0">
                                    @if($item->product && $item->product->images && $item->product->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                             alt="{{ $item->product->name }}"
                                             class="w-20 h-20 object-cover rounded-lg">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-800 dark:text-white truncate">{{ $item->product ? $item->product->name : 'Product Not Found' }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $item->quantity }}</p>
                                    @if($item->options)
                                        <p class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ json_encode($item->options) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-800 dark:text-white">Rs. {{ number_format($item->total, 2) }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Rs. {{ number_format($item->price, 2) }} each</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 sticky top-24">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-bold text-gray-800 dark:text-white">Order Summary</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rs. {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rs. 0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Tax</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rs. 0.00</span>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold text-gray-800 dark:text-white">Total</span>
                                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">Rs. {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-3">Shipping Address</h4>
                        <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                            <p>{{ $order->shipping_address }}</p>
                            @if($order->billing_address)
                                <p class="mt-2 font-semibold">Billing Address:</p>
                                <p>{{ $order->billing_address }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Information -->
                    @if($order->payment_method)
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-3">Payment Method</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 capitalize">
                            {{ str_replace('_', ' ', $order->payment_method) }}
                        </p>
                    </div>
                    @endif

                    <!-- Tracking Information -->
                    @if($order->tracking_number)
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-3">Tracking Number</h4>
                        <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                            {{ $order->tracking_number }}
                        </p>
                    </div>
                    @endif

                    <!-- Notes -->
                    @if($order->notes)
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-3">Order Notes</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
