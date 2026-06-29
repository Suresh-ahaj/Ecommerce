<x-frontend-layout>
    <div class="min-h-screen bg-gradient-to-b from-green-50 to-white dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Success Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header with Icon -->
                <div class="relative px-6 py-12 sm:px-12 text-center">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-emerald-500"></div>

                    <!-- Success Animation -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center animate-pulse">
                                <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <!-- Confetti effect -->
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full opacity-75 animate-bounce" style="animation-delay: 0.2s;"></div>
                            <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-pink-400 rounded-full opacity-75 animate-bounce" style="animation-delay: 0.5s;"></div>
                            <div class="absolute top-1/2 -left-4 w-4 h-4 bg-blue-400 rounded-full opacity-75 animate-bounce" style="animation-delay: 0.8s;"></div>
                        </div>
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                        🎉 Order Placed Successfully!
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        Thank you for your purchase. Your order has been confirmed.
                    </p>

                    <!-- Order Number -->
                    <div class="mt-4 inline-block bg-gray-100 dark:bg-gray-700 px-6 py-2 rounded-full">
                        <span class="text-sm text-gray-600 dark:text-gray-300">
                            Order #: <span class="font-semibold text-gray-900 dark:text-white">{{ session('order_id') ?? 'ORD-' . rand(100000, 999999) }}</span>
                        </span>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-8 sm:px-12">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Order Summary
                    </h2>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Payment Method</span>
                            <span class="font-medium text-gray-800 dark:text-white capitalize">
                                {{ session('payment_method', 'Cash on Delivery') }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Payment Status</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400">
                                {{ session('payment_status', 'Pending') }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                            <span class="text-base font-semibold text-gray-800 dark:text-white">Total Amount</span>
                            <span class="text-base font-bold text-green-600 dark:text-green-400">
                                Rs. {{ number_format(session('grand_total', 0), 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-8 sm:px-12 bg-gray-50 dark:bg-gray-900/30">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('home') }}"
                           class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3.5 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 text-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Continue Shopping
                        </a>
                        <a href="{{ route('my.orders') }}"
                           class="flex-1 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold py-3.5 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2 text-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            View Orders
                        </a>
                    </div>

                    <!-- Email confirmation message -->
                    <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        A confirmation email has been sent to your registered email address.
                    </p>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 text-center">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Order Confirmed</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Your order is being processed</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 text-center">
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Processing</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Preparing your order for shipping</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 text-center">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Delivery</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Estimated delivery in 3-5 days</p>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
