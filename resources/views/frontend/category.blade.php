<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white flex items-center gap-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Shop by Category
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Browse our products by category</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <!-- Category Card -->
                <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <a href="{{ route('products', ['categories[]' => $category->id]) }}" class="block">
                        <!-- Category Image -->
                        <div class="relative overflow-hidden h-48 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600">
                            @if($category->image)
                                <img
                                    src="{{ Storage::url($category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-300 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            <!-- Category Badge -->
                            <div class="absolute top-3 right-3 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm px-3 py-1 rounded-full shadow-md">
                                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                    {{ $category->products->count() }} Products
                                </span>
                            </div>
                        </div>

                        <!-- Category Content -->
                        <div class="p-5">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $category->name }}
                                    </h3>

                                    @if($category->parent)
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>
                                                </svg>
                                                Subcategory of {{ $category->parent->name }}
                                            </span>
                                        </p>
                                    @endif

                                    @if($category->children && $category->children->count() > 0)
                                        <div class="mt-3 flex flex-wrap gap-1.5">
                                            @foreach($category->children as $child)
                                                <a href="{{ route('products', ['categories[]' => $child->id]) }}"
                                                   class="inline-block text-xs px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/30 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                                    {{ $child->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <svg class="flex-shrink-0 w-5 h-5 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($categories->isEmpty())
            <div class="text-center py-16">
                <div class="flex justify-center mb-4">
                    <svg class="w-24 h-24 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">No Categories Found</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">There are no categories available at the moment.</p>
            </div>
        @endif
    </div>

    @push('styles')
    <style>
        .group:hover .group-hover\:translate-x-1 {
            transform: translateX(4px);
        }
        .group:hover .group-hover\:scale-110 {
            transform: scale(1.1);
        }
    </style>
    @endpush
</x-frontend-layout>
