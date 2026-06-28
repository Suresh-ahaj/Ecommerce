<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
            <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
                <div class="flex flex-wrap  mb-24 -mx-3">
                    <!-- Sidebar Filters -->
                    <div class="w-full pr-2 lg:w-1/4 lg:block">
                        <form id="filterForm" action="{{ route('products') }}" method="GET">
                            <!-- Categories Filter -->
                            <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                                <h2 class="text-2xl font-bold dark:text-gray-400">Categories</h2>
                                <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li class="mb-4">
                                            <label for="category_{{ $category->id }}" class="flex items-center dark:text-gray-400">
                                                <input type="checkbox" name="categories[]"
                                                    id="category_{{ $category->id }}" value="{{ $category->id }}"
                                                    class="w-4 h-4 mr-2 filter-checkbox"
                                                    @if (request()->has('categories') && in_array($category->id, request()->categories)) checked @endif>
                                                <span class="text-lg">{{ $category->name }}</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Brands Filter -->
                            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                                <h2 class="text-2xl font-bold dark:text-gray-400">Brand</h2>
                                <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                                <ul>
                                    @foreach ($brands as $brand)
                                        <li class="mb-4">
                                            <label for="brand_{{ $brand->id }}" class="flex items-center dark:text-gray-300">
                                                <input type="checkbox" name="brands[]" id="brand_{{ $brand->id }}"
                                                    value="{{ $brand->id }}" class="w-4 h-4 mr-2 filter-checkbox"
                                                    @if (request()->has('brands') && in_array($brand->id, request()->brands)) checked @endif>
                                                <span class="text-lg dark:text-gray-400">{{ $brand->name }}</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Product Status Filter -->
                            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                                <h2 class="text-2xl font-bold dark:text-gray-400">Product Status</h2>
                                <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                                <ul>
                                    <li class="mb-4">
                                        <label for="in_stock" class="flex items-center dark:text-gray-300">
                                            <input type="checkbox" name="in_stock" id="in_stock" value="1"
                                                class="w-4 h-4 mr-2 filter-checkbox"
                                                @if (request()->has('in_stock') && request()->in_stock == 1) checked @endif>
                                            <span class="text-lg dark:text-gray-400">In Stock</span>
                                        </label>
                                    </li>
                                    <li class="mb-4">
                                        <label for="on_sale" class="flex items-center dark:text-gray-300">
                                            <input type="checkbox" name="on_sale" id="on_sale" value="1"
                                                class="w-4 h-4 mr-2 filter-checkbox"
                                                @if (request()->has('on_sale') && request()->on_sale == 1) checked @endif>
                                            <span class="text-lg dark:text-gray-400">On Sale</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>

                            <!-- Price Range Filter -->
                            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                                <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
                                <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                                <div>
                                    <input type="range" id="priceRange"
                                        class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                        min="0" max="500000"
                                        value="{{ request()->has('max_price') ? request()->max_price : 500000 }}"
                                        step="1000">
                                    <div class="flex justify-between">
                                        <span class="inline-block text-lg font-bold text-blue-400">₹ 0</span>
                                        <span id="priceDisplay" class="inline-block text-lg font-bold text-blue-400">₹
                                            {{ request()->has('max_price') ? number_format(request()->max_price) : '5,00,000' }}</span>
                                    </div>
                                    <input type="hidden" name="min_price" value="0">
                                    <input type="hidden" name="max_price" id="maxPrice"
                                        value="{{ request()->has('max_price') ? request()->max_price : 500000 }}">
                                </div>
                            </div>

                            <!-- Sort Filter -->
                            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                                <h2 class="text-2xl font-bold dark:text-gray-400">Sort By</h2>
                                <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                                <select name="sort" id="sortSelect"
                                    class="w-full p-2 border rounded dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </div>

                            <!-- Reset Button -->
                            <div class="p-4 mb-5">
                                <a href="{{ route('products') }}"
                                    class="block w-full px-4 py-2 text-center text-white bg-rose-600 rounded hover:bg-rose-700 transition">
                                    Reset Filters
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Products Grid -->
                    <div class="w-full px-3 lg:w-3/4">
                        <div class="px-3 mb-4">
                            <div class="items-center justify-between px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900">
                                <div class="flex items-center justify-between w-full">
                                    <span class="text-gray-600 dark:text-gray-400">
                                        Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}
                                        of {{ $products->total() }} products
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Products Grid -->
                        <div class="flex flex-wrap items-center" id="productGrid">
                            @forelse ($products as $product)
                                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
                                    <div class="border border-gray-300 dark:border-gray-700 h-full">
                                        <div class="relative bg-gray-200">
                                            <a href="{{ route('product', $product->slug) }}">
                                                @if (!empty($product->image) && isset($product->image[0]))
                                                    <img src="{{ Storage::url($product->image[0]) }}"
                                                        alt="{{ $product->name }}" class="object-cover w-full h-56">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}"
                                                        class="object-cover w-full h-56">
                                                @endif
                                            </a>
                                            @if ($product->on_sale)
                                                <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded">Sale</span>
                                            @endif
                                            @if (!$product->in_stock)
                                                <span class="absolute top-2 left-2 bg-gray-500 text-white px-2 py-1 text-xs rounded">Out of Stock</span>
                                            @endif
                                        </div>
                                        <div class="p-3">
                                            <div class="flex items-center justify-between gap-2 mb-2">
                                                <h3 class="text-xl font-medium dark:text-gray-400">
                                                   {{ Str::limit($product->name, 20) }}
                                                </h3>
                                            </div>
                                            <p class="text-lg">
                                                <span class="text-green-600 dark:text-green-600">₹
                                                    {{ number_format($product->price) }}</span>
                                            </p>
                                        </div>

                                        <!-- Add to Cart Button -->
                                        <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                            @if($product->in_stock && $product->is_active)
                                                <button
                                                    type="button"
                                                    class="add-to-cart-btn text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300"
                                                    data-product-id="{{ $product->id }}"
                                                    onclick="addToCart({{ $product->id }})"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="w-4 h-4 bi bi-cart3" viewBox="0 0 16 16">
                                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                                    </svg>
                                                    <span class="btn-text">Add to Cart</span>
                                                </button>
                                            @else
                                                <span class="text-gray-400 cursor-not-allowed">
                                                    {{ !$product->is_active ? 'Unavailable' : 'Out of Stock' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="w-full px-3 py-12 text-center">
                                    <p class="text-xl text-gray-600 dark:text-gray-400">No products found matching your filters.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-end mt-6">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>

    @push('scripts')
    <script>
        // =============================================
        // ADD TO CART FUNCTION
        // =============================================
        function addToCart(productId) {
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                showToast('CSRF token not found. Please refresh the page.', 'error');
                return;
            }

            // Find the button
            const btn = document.querySelector(`[data-product-id="${productId}"]`);
            if (!btn) {
                showToast('Button not found!', 'error');
                return;
            }

            // Show loading state
            const textSpan = btn.querySelector('.btn-text');
            const originalText = textSpan ? textSpan.textContent : 'Add to Cart';
            if (textSpan) textSpan.textContent = 'Adding...';
            btn.disabled = true;
            btn.style.opacity = '0.7';

            // Prepare data
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1);

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

                    // Reset button after 2 seconds
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
        // UPDATE CART COUNT
        // =============================================
        function updateCartCount(count) {
            const cartBadge = document.querySelector('.cart-count');
            if (cartBadge) {
                cartBadge.textContent = count;
                cartBadge.style.display = count > 0 ? 'flex' : 'none';
            }
        }

        // =============================================
        // SHOW TOAST NOTIFICATION
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
            toast.className = `
                ${colors[type] || colors.success}
                text-white px-6 py-3 rounded-lg shadow-lg
                transform transition-all duration-300
                translate-x-full mb-2 max-w-md
            `;
            toast.innerHTML = message;

            container.appendChild(toast);

            // Slide in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
                toast.classList.add('translate-x-0');
            }, 100);

            // Slide out and remove
            setTimeout(() => {
                toast.classList.remove('translate-x-0');
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // =============================================
        // FILTER FORM AUTO-SUBMIT
        // =============================================
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const priceRange = document.getElementById('priceRange');
            const priceDisplay = document.getElementById('priceDisplay');
            const maxPriceInput = document.getElementById('maxPrice');
            let timeoutId = null;

            // Price range slider
            if (priceRange) {
                priceRange.addEventListener('input', function() {
                    const value = this.value;
                    priceDisplay.textContent = '₹ ' + parseInt(value).toLocaleString('en-IN');
                    maxPriceInput.value = value;
                    submitForm();
                });
            }

            // Checkbox filters
            document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    submitForm();
                });
            });

            // Sort filter
            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    submitForm();
                });
            }

            // Debounced form submission
            function submitForm() {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    form.submit();
                }, 500);
            }
        });
    </script>
    @endpush

    <style>
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
            opacity: 0.6;
        }
    </style>
</x-frontend-layout>
