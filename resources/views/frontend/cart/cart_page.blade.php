<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(empty($cart))
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="text-6xl mb-4">🛒</div>
                    <h2 class="text-2xl font-semibold mb-4">Your cart is empty</h2>
                    <p class="text-gray-600 mb-6">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('products') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                        Continue Shopping
                    </a>
                </div>
            @else
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="md:w-3/4">
                        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                            <table class="w-full table-auto border-collapse">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold">Product</th>
                                        <th class="px-4 py-3 text-left font-semibold">Price</th>
                                        <th class="px-4 py-3 text-left font-semibold">Quantity</th>
                                        <th class="px-4 py-3 text-left font-semibold">Total</th>
                                        <th class="px-4 py-3 text-left font-semibold">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $productId => $item)
                                    <tr class="border-t" id="cart-item-{{ $productId }}">
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                @if($item['image'])
                                                    <img class="h-16 w-16 mr-4 object-cover rounded" src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}">
                                                @else
                                                    <img class="h-16 w-16 mr-4 object-cover rounded" src="{{ asset('images/no-image.png') }}" alt="{{ $item['name'] }}">
                                                @endif
                                                <span class="font-semibold">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">Rs.{{ number_format($item['price'], 2) }}</td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-2">

                                                <span class="text-center w-8 quantity-display" id="quantity-{{ $productId }}">{{ $item['quantity'] }}</span>

                                            </div>
                                        </td>
                                        <td class="px-4 py-4 item-total" id="total-{{ $productId }}">Rs.{{ number_format($item['total'], 2) }}</td>
                                      <td>
    <form action="{{ route('cart.remove') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $productId }}">

        <button
            type="submit"
            class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700"
            onclick="return confirm('Are you sure you want to remove this item?')">
            Remove
        </button>
    </form>
</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-between">
                            <a href="{{ route('products') }}" class="text-blue-500 hover:underline">
                                ← Continue Shopping
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to clear your cart?')">
                                    Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="md:w-1/4">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-lg font-semibold mb-4">Summary</h2>
                            <div class="flex justify-between mb-2">
                                <span>Subtotal</span>
                                <span id="subtotal">${{ number_format($cartTotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Taxes (10%)</span>
                                <span id="taxes">${{ number_format($taxes, 2) }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Shipping</span>
                                <span id="shipping">${{ number_format($shippingAmount, 2) }}</span>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Total</span>
                                <span class="font-semibold" id="grand-total">${{ number_format($grandTotal, 2) }}</span>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg mt-4 w-full block text-center transition">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity buttons
            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const productId = this.dataset.productId;
                    const action = this.dataset.action;

                    fetch('{{ route("cart.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            action: action
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update quantity display
                            document.getElementById(`quantity-${productId}`).textContent = data.quantity;

                            // Update item total
                            document.getElementById(`total-${productId}`).textContent = '$' + data.item_total.toFixed(2);

                            // Update cart totals
                            updateCartTotals(data);

                            // Update cart count in header
                            updateCartCount(data.cart_count);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            // Remove item
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (!confirm('Are you sure you want to remove this item?')) {
                        return;
                    }

                    const productId = this.dataset.productId;

                    fetch('{{ route("cart.remove") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {


                            // Update cart totals
                            updateCartTotals(data);

                            // Update cart count in header
                            updateCartCount(data.cart_count);

                            // If cart is empty, reload page
                            if (data.cart_count === 0) {
                                location.reload();
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            // Update cart totals
            function updateCartTotals(data) {
                // Fetch updated cart totals from server
                fetch('{{ route("cart.index") }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Parse HTML to get updated values
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const subtotal = doc.querySelector('#subtotal');
                    const taxes = doc.querySelector('#taxes');
                    const grandTotal = doc.querySelector('#grand-total');

                    if (subtotal) document.getElementById('subtotal').textContent = subtotal.textContent;
                    if (taxes) document.getElementById('taxes').textContent = taxes.textContent;
                    if (grandTotal) document.getElementById('grand-total').textContent = grandTotal.textContent;
                })
                .catch(error => console.error('Error:', error));
            }

            // Update cart count in header
            function updateCartCount(count) {
                const cartBadge = document.querySelector('.cart-count');
                if (cartBadge) {
                    cartBadge.textContent = count;
                    if (count === 0) {
                        cartBadge.style.display = 'none';
                    } else {
                        cartBadge.style.display = 'inline';
                    }
                }
            }
        });
    </script>
    @endpush
</x-frontend-layout>
