<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('my.orders') }}" 
               class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Orders
            </a>
        </div>

        <!-- Order Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Order #{{ $order->id }}</h1>
                    <span class="text-xs text-gray-400 dark:text-gray-500 font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                        {{ $order->created_at->format('Y-m-d') }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}
                    </span>
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium text-white shadow-sm
                    {{ $order->status == 'delivered' ? 'bg-gradient-to-r from-green-500 to-emerald-600' : 
                       ($order->status == 'canceled' ? 'bg-gradient-to-r from-red-500 to-rose-600' : 
                       ($order->status == 'shipped' ? 'bg-gradient-to-r from-purple-500 to-indigo-600' : 
                       ($order->status == 'processing' ? 'bg-gradient-to-r from-yellow-500 to-orange-500' : 'bg-gradient-to-r from-blue-500 to-cyan-600'))) }}">
                    <span class="w-2 h-2 rounded-full bg-white/50 mr-2 animate-pulse"></span>
                    {{ ucfirst($order->status) }}
                </span>
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium text-white shadow-sm
                    {{ $order->payment_status == 'paid' ? 'bg-gradient-to-r from-green-500 to-emerald-600' : 
                       ($order->payment_status == 'failed' ? 'bg-gradient-to-r from-red-500 to-rose-600' : 
                       ($order->payment_status == 'refunded' ? 'bg-gradient-to-r from-orange-500 to-amber-600' : 'bg-gradient-to-r from-yellow-500 to-orange-500')) }}">
                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    {{ ucfirst($order->payment_status ?? 'Pending') }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Items - Left Column (2/3 width) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Order Items
                            </h2>
                            <span class="text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 px-3 py-1 rounded-full">
                                {{ $order->orderItems->count() }} items
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        @foreach($order->orderItems as $item)
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl hover:shadow-md transition-shadow duration-200 border border-transparent hover:border-gray-200 dark:hover:border-gray-600 group">
                           
                            
                            <!-- Product Details -->
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-800 dark:text-white truncate" title="{{ $item->product->name ?? 'Product Unavailable' }}">
                                    {{ Str::limit($item->product->name ?? 'Product Unavailable', 30) }}
                                </h4>
                                <div class="flex flex-wrap items-center gap-3 mt-1">
                                    <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        Qty: {{ $item->quantity }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 1v1m0 1v1m0 1v1"/>
                                        </svg>
                                        {{ number_format($item->unit_amount ?? 0, 2) }} each
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="text-right sm:text-left sm:ml-auto">
                                <p class="text-base font-bold text-gray-800 dark:text-white">
                                    Rs. {{ number_format($item->total_amount ?? 0, 2) }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    @ {{ number_format($item->unit_amount ?? 0, 2) }} each
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary - Right Column (1/3 width) -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Order Summary Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-6 3v-3m-6 3h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Order Summary
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                                <span class="font-medium text-gray-800 dark:text-white">
                                    Rs. {{ number_format($order->grand_total - ($order->shipping_amount ?? 0), 2) }}
                                </span>
                            </div>
                            
                            @if($order->shipping_amount > 0)
                            <div class="flex justify-between text-sm border-b border-dashed border-gray-200 dark:border-gray-700 pb-3">
                                <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                                <span class="font-medium text-gray-800 dark:text-white">
                                    Rs. {{ number_format($order->shipping_amount, 2) }}
                                </span>
                            </div>
                            @else
                            <div class="border-b border-dashed border-gray-200 dark:border-gray-700 pb-3"></div>
                            @endif
                            
                            <div class="flex justify-between pt-1">
                                <span class="text-lg font-semibold text-gray-800 dark:text-white">Total</span>
                                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                    Rs. {{ number_format($order->grand_total ?? 0, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment & Shipping Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Order Information
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4 text-sm">
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Payment Method</p>
                                    <p class="font-medium text-gray-800 dark:text-white">
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'Not specified')) }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Shipping Method</p>
                                    <p class="font-medium text-gray-800 dark:text-white">
                                        {{ ucfirst(str_replace('_', ' ', $order->shipping_method ?? 'Not specified')) }}
                                    </p>
                                </div>
                            </div>
                            
                            @if($order->notes)
                            <div class="flex items-start gap-3 pt-2 border-t border-gray-200 dark:border-gray-700">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Order Notes</p>
                                    <p class="font-medium text-gray-800 dark:text-white">
                                        {{ $order->notes }}
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                @if($order->address)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Shipping Address
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-600 dark:text-gray-300 space-y-1.5">
                            <p class="font-semibold text-gray-800 dark:text-white text-base">
                                {{ $order->address->recipient_name ?? 'N/A' }}
                            </p>
                            <p class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $order->address->street_address ?? 'N/A' }}
                            </p>
                            <p class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $order->address->city ?? 'N/A' }}, {{ $order->address->state ?? 'N/A' }}
                            </p>
                            <p class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                {{ $order->address->postal_code ?? 'N/A' }}, {{ $order->address->country ?? 'N/A' }}
                            </p>
                            <p class="flex items-start gap-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $order->address->phone ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-frontend-layout>