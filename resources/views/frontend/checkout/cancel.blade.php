<x-frontend-layout>
    <div class="min-h-screen bg-gradient-to-b from-red-50 to-white dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Cancel Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header with Icon -->
                <div class="relative px-6 py-12 sm:px-12 text-center">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-red-400 to-orange-500"></div>

                    <!-- Cancel Icon -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="w-24 h-24 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                        Payment Cancelled
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        Your payment was not completed.
                    </p>
                </div>

                <!-- Details -->
                <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-8 sm:px-12">
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 dark:border-yellow-500 p-4 rounded-r-lg mb-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                    <strong>Don't worry!</strong> Your cart items have been saved. You can try again or choose a different payment method.
                                </p>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        What would you like to do?
                    </h2>

                    <div class="space-y-3">
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Your order was not placed. Here are your options:
                        </p>
                        <ul class="list-disc list-inside text-sm text-gray-600 dark:text-gray-300 space-y-1 ml-2">
                            <li>Try again with a different payment method</li>
                            <li>Update your cart before checking out</li>
                            <li>Contact us if you need assistance</li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-8 sm:px-12 bg-gray-50 dark:bg-gray-900/30">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('checkout.index') }}"
                           class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3.5 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 text-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Try Again
                        </a>
                        <a href="{{ route('cart.index') }}"
                           class="flex-1 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold py-3.5 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2 text-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            View Cart
                        </a>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 mt-3">
                        <a href="{{ route('home') }}"
                           class="flex-1 text-center text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors py-2">
                            ← Continue Shopping
                        </a>
                        <a href="{{ route('contact') }}"
                           class="flex-1 text-center text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors py-2">
                            Need Help? Contact Us →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Support Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 text-center">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Live Support</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Chat with our support team</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 text-center">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Email Support</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">support@yourstore.com</p>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
