<x-frontend-layout>

<div class="max-w-[85rem] mx-auto px-4 py-10">

    <h2 class="text-3xl font-bold mb-8">
        {{ $category->name }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($products as $product)

            <div class="border rounded-lg p-4">

                @php
                    $images = json_decode($product->images, true);
                @endphp

                @if(!empty($images) && isset($images[0]))
                    <img
                        src="{{ asset('storage/' . $images[0]) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-52 object-cover rounded-lg"
                        onerror="this.src='{{ asset('images/no-image.png') }}'"
                    >
                @else
                    <div class="w-full h-52 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif

                <h3 class="mt-3 font-semibold text-gray-800 dark:text-white">
                    {{ $product->name }}
                </h3>

                <p class="text-blue-600 font-bold mt-1">
                    Rs. {{ number_format($product->price, 2) }}
                </p>

                <a href="{{ route('product', $product->slug) }}"
                   class="mt-3 inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition duration-200">
                    View Details
                </a>

            </div>

        @empty

            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-lg">No products found in this category.</p>
            </div>

        @endforelse

    </div>

    @if($products->hasPages())
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif

</div>

</x-frontend-layout>
