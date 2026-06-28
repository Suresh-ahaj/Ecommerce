<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Breadcrumb Navigation -->
        <nav class="flex mb-8 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2">/</span>
                        <a href="{{ route('products') }}" class="hover:text-blue-600 dark:hover:text-blue-400">Products</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2">/</span>
                        <a href="{{ route('category', $product->category_id) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                            {{ $product->category->name ?? 'Category' }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2">/</span>
                        <span class="text-gray-600 dark:text-gray-300">{{ Str::limit($product->name, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Main Section -->
        <section class="overflow-hidden bg-white rounded-xl shadow-sm dark:bg-gray-800">
            <div class="max-w-6xl px-4 py-8 mx-auto lg:py-12 md:px-6">
                <div class="flex flex-wrap -mx-4">
                    <!-- Product Image Gallery -->
                    <div class="w-full mb-8 md:w-1/2 md:mb-0">
                        <div class="px-4">
                            <!-- Main Image -->
                            <div class="relative overflow-hidden bg-gray-100 rounded-lg dark:bg-gray-700">
                                @php
                                    $images = is_array($product->image) ? $product->image : json_decode($product->image, true);
                                    $firstImage = !empty($images) && is_array($images) ? $images[0] : null;
                                @endphp

                                <img src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('images/no-image.png') }}"
                                    alt="{{ $product->name }}" id="mainImage"
                                    class="object-contain w-full h-[400px] md:h-[500px] hover:scale-105 transition-transform duration-300">

                                <!-- Badges -->
                                @if ($product->is_featured)
                                    <span class="absolute top-4 left-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                        Featured
                                    </span>
                                @endif
                                @if ($product->on_sale)
                                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                        Sale
                                    </span>
                                @endif
                                @if (!$product->in_stock)
                                    <span class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-red-600 text-white text-sm font-bold px-6 py-2 rounded-full">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>

                            <!-- Thumbnail Gallery -->
                            @if (!empty($images) && is_array($images) && count($images) > 1)
                                <div class="grid grid-cols-4 gap-3 mt-4">
                                    @foreach ($images as $index => $image)
                                        <div class="overflow-hidden border-2 rounded-lg cursor-pointer transition-all duration-200
                                            {{ $index === 0 ? 'border-blue-500 dark:border-blue-400' : 'border-transparent hover:border-blue-300 dark:hover:border-blue-500' }}"
                                            onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                alt="{{ $product->name }} - thumbnail {{ $index + 1 }}"
                                                class="object-cover w-full h-24 hover:scale-110 transition-transform duration-200">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="w-full px-4 md:w-1/2">
                        <div class="lg:pl-8">
                            <!-- Product Name & Meta -->
                            <div class="mb-6">
                                <h1 class="text-2xl font-bold text-gray-800 dark:text-white md:text-3xl lg:text-4xl">
                                    {{ $product->name }}
                                </h1>

                                <div class="flex flex-wrap items-center gap-2 mt-3">
                                    @if ($product->brand)
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            Brand: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $product->brand->name }}</span>
                                        </span>
                                        <span class="text-gray-300 dark:text-gray-600">|</span>
                                    @endif
                                    @if ($product->category)
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            Category: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $product->category->name }}</span>
                                        </span>
                                    @endif
                                </div>

                                <!-- Rating -->
                                <div class="flex items-center mt-3 space-x-2">
                                    <div class="flex text-yellow-400">
                                        @php
                                            $rating = $product->rating ?? 4.5;
                                            $fullStars = floor($rating);
                                            $halfStar = $rating - $fullStars >= 0.5;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <span>★</span>
                                            @elseif($i == $fullStars + 1 && $halfStar)
                                                <span>★</span>
                                            @else
                                                <span class="text-gray-300 dark:text-gray-600">★</span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">({{ number_format($rating, 1) }}/5)</span>
                                    <span class="text-sm text-gray-400">•</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $product->reviews_count ?? 0 }} reviews</span>
                                </div>
                            </div>

                            <!-- Price Section -->
                            <div class="mb-6">
                                <div class="flex items-center space-x-3 flex-wrap">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white md:text-4xl">
                                        Rs {{ number_format($product->price, 2) }}
                                    </span>
                                    @if ($product->on_sale && isset($product->sale_price) && $product->sale_price < $product->price)
                                        <span class="text-lg text-gray-400 line-through">
                                            Rs {{ number_format($product->sale_price, 2) }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded dark:bg-green-900 dark:text-green-200">
                                            Save Rs {{ number_format($product->price - $product->sale_price, 2) }}
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-2 text-sm {{ $product->in_stock ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $product->in_stock ? '✓ In Stock' : '✗ Out of Stock' }}
                                    @if ($product->in_stock)
                                        | Free Delivery
                                    @endif
                                </p>
                            </div>

                            <!-- Quantity Selector -->
                            @if ($product->in_stock)
                                <div class="mb-8">
                                    <label class="block mb-2 text-sm font-semibold text-gray-600 uppercase dark:text-gray-400">
                                        Quantity
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center border-2 border-gray-300 rounded-lg dark:border-gray-600">
                                            <button type="button" onclick="updateQuantity(-1)"
                                                class="px-4 py-2 text-2xl font-thin text-gray-600 transition-colors hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300 rounded-l-lg">
                                                −
                                            </button>
                                            <input type="number" id="quantityInput"
                                                class="w-16 py-2 text-center border-0 focus:ring-0 dark:bg-gray-800 dark:text-white"
                                                value="1" min="1" max="99">
                                            <button type="button" onclick="updateQuantity(1)"
                                                class="px-4 py-2 text-2xl font-thin text-gray-600 transition-colors hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300 rounded-r-lg">
                                                +
                                            </button>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            In Stock
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                                @if ($product->in_stock && $product->is_active)
                                    <button onclick="addToCart({{ $product->id }})"
                                        class="flex-1 px-6 py-4 text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transform hover:scale-[1.02] active:scale-[0.98] add-to-cart-btn"
                                        id="addToCartBtn">
                                        <span class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span id="addToCartText">Add to Cart</span>
                                        </span>
                                    </button>
                                    <button onclick="buyNow({{ $product->id }})"
                                        class="flex-1 px-6 py-4 text-gray-700 transition-all bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transform hover:scale-[1.02] active:scale-[0.98]">
                                        Buy Now
                                    </button>
                                @else
                                    <button disabled
                                        class="flex-1 px-6 py-4 text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500">
                                        {{ !$product->is_active ? 'Product Unavailable' : 'Out of Stock' }}
                                    </button>
                                @endif
                                <button onclick="toggleWishlist({{ $product->id }})"
                                    class="px-6 py-4 text-gray-500 transition-all border-2 border-gray-300 rounded-lg hover:bg-gray-50 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 transform hover:scale-[1.05] active:scale-[0.95]"
                                    id="wishlistBtn">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Additional Info -->
                            <div class="grid grid-cols-2 gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center space-x-3 group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Free Shipping</span>
                                </div>
                                <div class="flex items-center space-x-3 group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">30-Day Returns</span>
                                </div>
                                <div class="flex items-center space-x-3 group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">1-3 Day Delivery</span>
                                </div>
                                <div class="flex items-center space-x-3 group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Secure Payment</span>
                                </div>
                            </div>

                            <!-- Product Status -->
                            <div class="flex flex-wrap items-center gap-4 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Status:</span>
                                @if ($product->is_active)
                                    <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">
                                        Active
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-200">
                                        Inactive
                                    </span>
                                @endif
                                @if ($product->is_featured)
                                    <span class="px-3 py-1 text-xs font-semibold text-purple-700 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-200">
                                        Featured
                                    </span>
                                @endif
                            </div>

                            <!-- Share Buttons -->
                            <div class="flex items-center space-x-4 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Share:</span>
                                <button class="text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </button>
                                <button class="text-gray-400 hover:text-blue-700 dark:hover:text-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                    </svg>
                                </button>
                                <button class="text-gray-400 hover:text-blue-800 dark:hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product Description Section (Below Image) -->
        <section class="mt-8 overflow-hidden bg-white rounded-xl shadow-sm dark:bg-gray-800">
            <div class="max-w-6xl px-4 py-8 mx-auto md:px-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Product Description</h2>
                <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                    <div id="descriptionContent" class="description-content">
                        {!! $product->description !!}
                    </div>
                    <button id="seeMoreBtn" onclick="toggleDescription()"
                        class="mt-4 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-semibold focus:outline-none">
                        See More ▼
                    </button>
                </div>
            </div>
        </section>

        <!-- Related Products -->
        @if (isset($relatedProducts) && $relatedProducts->count() > 0)
            <section class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Related Products</h2>
                    <a href="{{ route('products') }}"
                        class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                        View All →
                    </a>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($relatedProducts as $related)
                        <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                            <a href="{{ route('product', $related->slug) }}">
                                @php
                                    $relatedImages = is_array($related->image) ? $related->image : json_decode($related->image, true);
                                    $relatedFirstImage = !empty($relatedImages) && is_array($relatedImages) ? $relatedImages[0] : null;
                                @endphp
                                <img src="{{ $relatedFirstImage ? asset('storage/' . $relatedFirstImage) : asset('images/no-image.png') }}"
                                    alt="{{ $related->name }}"
                                    class="object-cover w-full h-48 hover:scale-105 transition-transform duration-300">
                            </a>
                            <div class="p-4">
                                <a href="{{ route('product', $related->slug) }}" class="block">
                                    <h3 class="text-sm font-medium text-gray-800 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        {{ Str::limit($related->name, 40) }}
                                    </h3>
                                </a>
                                <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">
                                    Rs {{ number_format($related->price, 2) }}
                                </p>
                                <div class="flex items-center gap-2 mt-2">
                                    @if ($related->is_featured)
                                        <span class="px-2 py-1 text-xs font-semibold text-purple-700 bg-purple-100 rounded dark:bg-purple-900 dark:text-purple-200">
                                            Featured
                                        </span>
                                    @endif
                                    @if (!$related->in_stock)
                                        <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded dark:bg-red-900 dark:text-red-200">
                                            Out of Stock
                                        </span>
                                    @endif
                                </div>
                                <button onclick="quickAddToCart({{ $related->id }}, this)"
                                    class="w-full mt-3 px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors transform hover:scale-[1.02] active:scale-[0.98] quick-add-btn"
                                    {{ !$related->in_stock ? 'disabled' : '' }}>
                                    {{ $related->in_stock ? 'Add to Cart' : 'Unavailable' }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <script>
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        // =============================================
        // TOGGLE DESCRIPTION (SEE MORE/LESS)
        // =============================================
        function toggleDescription() {
            const content = document.getElementById('descriptionContent');
            const btn = document.getElementById('seeMoreBtn');

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                btn.innerHTML = 'See More ▼';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                btn.innerHTML = 'See Less ▲';
            }
        }

        // Initialize description with collapsed state
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.getElementById('descriptionContent');
            if (content) {
                // Set initial max-height to show only first few lines
                content.style.maxHeight = '150px';
                content.style.overflow = 'hidden';
                content.style.transition = 'max-height 0.3s ease';
            }
        });

        // =============================================
        // QUANTITY CONTROL
        // =============================================
        function updateQuantity(delta) {
            const input = document.getElementById('quantityInput');
            if (!input) return;

            let value = parseInt(input.value) + delta;
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || 99;

            if (value < min) value = min;
            if (value > max) value = max;

            input.value = value;
        }

        // =============================================
        // CHANGE MAIN IMAGE
        // =============================================
        function changeMainImage(imageUrl, element) {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.src = imageUrl;
            }

            document.querySelectorAll('.grid .overflow-hidden').forEach(thumb => {
                thumb.classList.remove('border-blue-500', 'dark:border-blue-400');
                thumb.classList.add('border-transparent');
            });
            element.classList.remove('border-transparent');
            element.classList.add('border-blue-500', 'dark:border-blue-400');
        }

        // =============================================
        // ADD TO CART
        // =============================================
        function addToCart(productId) {
            const quantity = document.getElementById('quantityInput')?.value || 1;
            const btn = document.getElementById('addToCartBtn');
            const textSpan = document.getElementById('addToCartText');

            if (!btn) return;

            // Show loading state
            const originalText = textSpan ? textSpan.textContent : 'Add to Cart';
            if (textSpan) textSpan.textContent = 'Adding...';
            btn.disabled = true;
            btn.style.opacity = '0.7';

            // Prepare data
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', quantity);

            // Send AJAX request
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast(data.message || 'Product added to cart!', 'success');
                    updateCartCount(data.cart_count);

                    // Show success state
                    btn.style.backgroundColor = '#22c55e';
                    btn.style.color = 'white';
                    if (textSpan) textSpan.textContent = 'Added! ✓';

                    setTimeout(() => {
                        btn.style.backgroundColor = '';
                        btn.style.color = '';
                        if (textSpan) textSpan.textContent = originalText;
                        btn.disabled = false;
                        btn.style.opacity = '1';
                    }, 2000);
                } else {
                    showToast(data.message || 'Error adding to cart', 'error');
                    if (textSpan) textSpan.textContent = originalText;
                    btn.disabled = false;
                    btn.style.opacity = '1';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error adding to cart. Please try again.', 'error');
                if (textSpan) textSpan.textContent = originalText;
                btn.disabled = false;
                btn.style.opacity = '1';
            });
        }

        // =============================================
        // QUICK ADD TO CART (Related Products)
        // =============================================
        function quickAddToCart(productId, button) {
            const btn = button || document.querySelector(`[onclick^="quickAddToCart(${productId})"]`);
            if (!btn) return;

            const originalText = btn.textContent;
            btn.textContent = 'Adding...';
            btn.disabled = true;

            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1);

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message || 'Product added to cart!', 'success');
                    updateCartCount(data.cart_count);
                    btn.textContent = 'Added! ✓';
                    btn.style.backgroundColor = '#22c55e';

                    setTimeout(() => {
                        btn.textContent = originalText;
                        btn.style.backgroundColor = '';
                        btn.disabled = false;
                    }, 2000);
                } else {
                    showToast(data.message || 'Error adding to cart', 'error');
                    btn.textContent = originalText;
                    btn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error adding to cart. Please try again.', 'error');
                btn.textContent = originalText;
                btn.disabled = false;
            });
        }

        // =============================================
        // BUY NOW
        // =============================================
        function buyNow(productId) {
            const quantity = document.getElementById('quantityInput')?.value || 1;

            // Show loading state on button
            const btns = document.querySelectorAll('[onclick^="buyNow"]');
            const btn = btns[0];
            if (btn) {
                const originalText = btn.innerHTML;
                btn.innerHTML = `<span class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Processing...</span>
                </span>`;
                btn.disabled = true;
            }

            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', quantity);

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("checkout.index") }}';
                } else {
                    showToast(data.message || 'Error adding to cart', 'error');
                    if (btn) {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error processing your request. Please try again.', 'error');
                if (btn) {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            });
        }

        // =============================================
        // WISHLIST TOGGLE
        // =============================================
        function toggleWishlist(productId) {
            const btn = document.getElementById('wishlistBtn');
            if (!btn) return;

            const icon = btn.querySelector('svg');

            if (btn.classList.contains('text-red-500')) {
                btn.classList.remove('text-red-500', 'border-red-500');
                btn.classList.add('text-gray-500', 'border-gray-300', 'dark:border-gray-600');
                if (icon) icon.style.fill = 'none';
                showToast('Removed from wishlist', 'info');
            } else {
                btn.classList.add('text-red-500', 'border-red-500');
                btn.classList.remove('text-gray-500', 'border-gray-300', 'dark:border-gray-600');
                if (icon) icon.style.fill = 'currentColor';
                showToast('Added to wishlist! ❤️', 'success');
            }
        }

        // =============================================
        // TOAST NOTIFICATION
        // =============================================
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            if (!container) {
                alert(message);
                return;
            }

            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500'
            };

            const toast = document.createElement('div');
            toast.className = `${colors[type] || colors.success} text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full mb-2 max-w-md`;
            toast.innerHTML = message;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-x-full');
                toast.classList.add('translate-x-0');
            }, 100);

            setTimeout(() => {
                toast.classList.remove('translate-x-0');
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // =============================================
        // UPDATE CART COUNT
        // =============================================
        function updateCartCount(count) {
            const cartBadge = document.querySelector('.cart-count');
            if (cartBadge) {
                cartBadge.textContent = count;
                if (count === 0) {
                    cartBadge.style.display = 'none';
                } else {
                    cartBadge.style.display = 'flex';
                }
            }
        }

        // =============================================
        // KEYBOARD SHORTCUTS
        // =============================================
        document.addEventListener('keydown', function(e) {
            const input = document.getElementById('quantityInput');
            if (document.activeElement === input) {
                if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    updateQuantity(1);
                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    updateQuantity(-1);
                }
            }
        });
    </script>

    <style>
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        .translate-x-full {
            transform: translateX(100%);
        }
        .translate-x-0 {
            transform: translateX(0);
        }
        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        .add-to-cart-btn {
            transition: all 0.3s ease;
        }
        .add-to-cart-btn:disabled {
            cursor: not-allowed;
        }

        /* Description styles */
        .description-content {
            transition: max-height 0.3s ease;
            overflow: hidden;
            max-height: 150px;
        }
        .description-content p {
            margin-bottom: 1rem;
        }
        .description-content ul,
        .description-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .description-content li {
            margin-bottom: 0.5rem;
        }
    </style>
</x-frontend-layout>
