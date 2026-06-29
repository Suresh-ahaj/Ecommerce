<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Checkout
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Complete your order with shipping details and payment</p>
            </div>
            <a href="{{ route('cart.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Return to Cart
            </a>
        </div>

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-400 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Column - Shipping & Payment -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Shipping Address Card -->
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
                        <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="first_name">
                                        First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors @error('first_name') border-red-500 @enderror"
                                           id="first_name"
                                           name="first_name"
                                           type="text"
                                           value="{{ old('first_name', auth()->user()->name ?? '') }}"
                                           placeholder="John"
                                           required>
                                    @error('first_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="last_name">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors @error('last_name') border-red-500 @enderror"
                                           id="last_name"
                                           name="last_name"
                                           type="text"
                                           value="{{ old('last_name') }}"
                                           placeholder="Doe"
                                           required>
                                    @error('last_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="phone">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors @error('phone') border-red-500 @enderror"
                                       id="phone"
                                       name="phone"
                                       type="tel"
                                       value="{{ old('phone') }}"
                                       placeholder="+977 9800000000"
                                       required>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="street_address">
                                    Street Address <span class="text-red-500">*</span>
                                </label>
                                <input class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors @error('street_address') border-red-500 @enderror"
                                       id="street_address"
                                       name="street_address"
                                       type="text"
                                       value="{{ old('street_address') }}"
                                       placeholder="123 Main Street, Ward No. 5"
                                       required>
                                @error('street_address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="city">
                                        City <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors @error('city') border-red-500 @enderror"
                                           id="city"
                                           name="city"
                                           type="text"
                                           value="{{ old('city') }}"
                                           placeholder="Kathmandu"
                                           required>
                                    @error('city')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="state">
                                        State/Province <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors @error('state') border-red-500 @enderror"
                                           id="state"
                                           name="state"
                                           type="text"
                                           value="{{ old('state') }}"
                                           placeholder="Bagmati"
                                           required>
                                    @error('state')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="zip_code">
                                        ZIP/Postal Code <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors @error('zip_code') border-red-500 @enderror"
                                           id="zip_code"
                                           name="zip_code"
                                           type="text"
                                           value="{{ old('zip_code') }}"
                                           placeholder="44600"
                                           required>
                                    @error('zip_code')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="order_notes">
                                    Order Notes (Optional)
                                </label>
                                <textarea class="w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-colors"
                                          id="order_notes"
                                          name="order_notes"
                                          rows="2"
                                          placeholder="Special delivery instructions...">{{ old('order_notes') }}</textarea>
                            </div>
                    </div>
                </div>

                <!-- Payment Method Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Payment Method
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Cash on Delivery -->
                            <div>
                                <input class="hidden peer" id="payment_cod" name="payment_method" type="radio" value="cash_on_delivery" checked>
                                <label class="flex items-center justify-between w-full p-5 border-2 border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-all"
                                       for="payment_cod">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 1v1m0 1v1m0 1v1"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">Cash on Delivery</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Pay when you receive</p>
                                        </div>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 dark:border-gray-600 peer-checked:border-blue-600 peer-checked:bg-blue-600 flex items-center justify-center">
                                        <div class="w-2 h-2 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                    </div>
                                </label>
                            </div>

                            <!-- Stripe -->
                            <div>
                                <input class="hidden peer" id="payment_stripe" name="payment_method" type="radio" value="stripe">
                                <label class="flex items-center justify-between w-full p-5 border-2 border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-all"
                                       for="payment_stripe">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">Stripe</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Pay with credit/debit card</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="flex gap-1">
                                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM6 10h2v2H6v-2zm0 4h8v2H6v-2zm10 0h2v2h-2v-2zm-6-4h8v2h-8v-2z"/>
                                            </svg>
                                        </div>
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 dark:border-gray-600 peer-checked:border-blue-600 peer-checked:bg-blue-600 flex items-center justify-center">
                                            <div class="w-2 h-2 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                            id="place-order-btn"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3.5 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 text-base disabled:opacity-70 disabled:cursor-not-allowed">
                        <span id="btn-text">
                            <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            Place Order
                        </span>
                        <span id="btn-loading" class="hidden">
                            <svg class="animate-spin w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                    <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold py-3.5 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2 text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Update Cart
                    </a>
                </div>
                </form>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Order Summary Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden sticky top-6">
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
                                <span class="font-medium text-gray-800 dark:text-white">Rs. {{ number_format($subtotal ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Tax (10%)</span>
                                <span class="font-medium text-gray-800 dark:text-white">Rs. {{ number_format($taxes ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm border-b border-dashed border-gray-200 dark:border-gray-700 pb-3">
                                <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                                <span class="font-medium text-gray-800 dark:text-white">Rs. {{ number_format($shipping ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between pt-1">
                                <span class="text-lg font-semibold text-gray-800 dark:text-white">Grand Total</span>
                                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">Rs. {{ number_format($grand_total ?? 0, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basket Summary Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Your Cart
                            </h2>
                            <span class="text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-2.5 py-1 rounded-full font-medium">
                                {{ $cart_count ?? 0 }} items
                            </span>
                        </div>
                    </div>
                    <div class="p-4 max-h-[400px] overflow-y-auto">
                        @if(isset($cart_items) && $cart_items->count() > 0)
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                                @foreach($cart_items as $item)
                                <li class="py-4 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                            @if($item->product && $item->product->image)
                                                @php
                                                    $images = is_array($item->product->image) ? $item->product->image : json_decode($item->product->image, true);
                                                    $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                                                @endphp
                                                @if($firstImage)
                                                    <img src="{{ asset('storage/' . $firstImage) }}"
                                                         alt="{{ Str::limit($item->product->name ?? 'Product', 30) }}"
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 dark:text-white truncate" title="{{ $item->product->name ?? 'Product' }}">
                                                {{ Str::limit($item->product->name ?? 'Product', 25) }}
                                            </p>
                                            <div class="flex items-center gap-3 mt-0.5">
                                                <span class="text-xs text-gray-500 dark:text-gray-400">Qty: {{ $item->quantity }}</span>
                                                <span class="text-xs text-gray-400 dark:text-gray-500">×</span>
                                                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Rs. {{ number_format($item->unit_amount ?? 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                                Rs. {{ number_format(($item->unit_amount ?? 0) * ($item->quantity ?? 1), 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Your cart is empty</p>
                                <a href="{{ route('products') }}" class="text-blue-600 dark:text-blue-400 text-sm hover:underline mt-2 inline-block">
                                    Continue Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('checkout-form');
        const btn = document.getElementById('place-order-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');

        if (form) {
            form.addEventListener('submit', function() {
                btn.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
            });
        }
    });
    </script>
</x-frontend-layout>
