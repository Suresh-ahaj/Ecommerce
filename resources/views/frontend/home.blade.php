<x-frontend-layout>
    <!-- Hero Section -->
    <div class="w-full min-h-screen bg-gradient-to-r from-blue-200 to-cyan-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="container max-w-[85rem] px-4 sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center">
                <div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-gray-800 text-center lg:text-left">
                        Start your journey with <span class="text-blue-600">DCodeMania</span>
                    </h1>
                    <p class="mt-5 text-base sm:text-lg text-gray-700 text-center lg:text-left">
                        Purchase wide varieties of electronics products like Smartphones, Laptops, Smartwatches, Television and many more.
                    </p>

                    <!-- Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('register') }}">
                            Get started
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50" href="#">
                            Contact sales team
                        </a>
                    </div>
                    <!-- End Buttons -->

                    <!-- Review -->
                    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="py-5">
                            <div class="flex space-x-1">
                                <!-- Stars -->
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="mt-3 text-sm text-gray-800 dark:text-gray-200">
                                <span class="font-bold">4.6</span> /5 - from 12k reviews
                            </p>
                        </div>
                        <div class="py-5">
                            <div class="flex space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="mt-3 text-sm text-gray-800 dark:text-gray-200">
                                <span class="font-bold">4.8</span> /5 - from 5k reviews
                            </p>
                        </div>
                    </div>
                    <!-- End Review -->
                </div>
                <!-- End Col -->

                <div class="relative mt-10 lg:mt-0">
                    <img class="w-full max-w-md lg:max-w-full mx-auto rounded-xl" src="https://static.vecteezy.com/system/resources/previews/011/993/278/non_2x/3d-render-online-shopping-bag-using-credit-card-or-cash-for-future-use-credit-card-money-financial-security-on-mobile-3d-application-3d-shop-purchase-basket-retail-store-on-e-commerce-free-png.png" alt="E-commerce Shopping">
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </div>

    {{-- Brand Section --}}
    <section class="py-12 md:py-16 lg:py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                        Browse Popular <span class="text-blue-500">Brands</span>
                    </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-gray-500">
                    Explore our collection from top brands and find your perfect match.
                </p>
            </div>
        </div>

        {{-- Brands Grid --}}
        <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
            @if($brands->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($brands as $brand)
                        <a href="{{ route('products', ['brands[]' => $brand->id]) }}"
                           class="group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                            <div class="overflow-hidden">
                                @if($brand->image)
                                    <img
                                        src="{{ Storage::url($brand->image) }}"
                                        alt="{{ $brand->name }}"
                                        class="w-full h-52 sm:h-60 lg:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                                    >
                                @else
                                    <div class="w-full h-52 sm:h-60 lg:h-64 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500 text-lg">{{ $brand->name }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-center text-gray-800 group-hover:text-blue-600 transition-colors">
                                    {{ $brand->name }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No brands available at the moment.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Category Section --}}
    <div class="bg-orange-200 py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                        Browse <span class="text-blue-500">Categories</span>
                    </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-gray-700">
                    Discover products by category and find exactly what you need.
                </p>
            </div>
        </div>

        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            @if($categories->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($categories as $category)
                        <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800"
                           href="{{ route('products', ['categories[]' => $category->id]) }}">
                            <div class="p-4 md:p-5">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        @if($category->image)
                                            <img
                                                class="h-[2.375rem] w-[2.375rem] rounded-full object-cover"
                                                src="{{ Storage::url($category->image) }}"
                                                alt="{{ $category->name }}"
                                            >
                                          @else
                                            <div class="h-[2.375rem] w-[2.375rem] rounded-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-xs text-gray-600">{{ substr($category->name, 0, 2) }}</span>
                                            </div>
                                        @endif
                                        <div class="ms-3">
                                            <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                                {{ $category->name }}
                                            </h3>
                                            @if($category->products_count > 0)
                                                <p class="text-xs text-gray-500">
                                                    {{ $category->products_count }} products
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ps-3">
                                        <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m9 18 6-6-6-6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-700 text-lg">No categories available at the moment.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Customer Reviews Section --}}
    <section class="py-12 md:py-16 lg:py-20 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
            <div class="max-w-xl m-auto">
                <div class="text-center">
                    <div class="relative flex flex-col items-center">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                            Customer <span class="text-blue-500">Reviews</span>
                        </h1>
                        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                            <div class="flex-1 h-2 bg-blue-200"></div>
                            <div class="flex-1 h-2 bg-blue-400"></div>
                            <div class="flex-1 h-2 bg-blue-600"></div>
                        </div>
                    </div>
                    <p class="mb-12 text-base text-center text-gray-500">
                        See what our customers say about their experience with us.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Review Card 1 -->
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/rF6G0Dh9/pexels-emmy-e-2381069.jpg" alt="User" class="object-cover w-12 h-12 rounded-full">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Adren Roy</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Web Designer</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400">Joined 12, SEP, 2022</p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem cupiditate similique, iure minus sed fugit obcaecati minima quam reiciendis dicta!
                    </p>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <ul class="flex items-center justify-start mr-4">
                                @for($i = 1; $i <= 4; $i++)
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                    </li>
                                @endfor
                            </ul>
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating: <span class="font-semibold text-gray-600 dark:text-gray-300">4.0</span></h2>
                        </div>
                        <div class="flex items-center px-6 space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                        </svg>
                                    </a>
                                    <span>12</span>
                                </div>
                                <div class="flex text-sm text-gray-700 dark:text-gray-400">
                                    <a href="#" class="inline-flex hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat" viewBox="0 0 16 16">
                                            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                        </svg>
                                        Reply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review Card 2 -->
                <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                    <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                        <div class="flex items-center px-6 mb-2 md:mb-0">
                            <div class="flex mr-2 rounded-full">
                                <img src="https://i.postimg.cc/q7pv50zT/pexels-edmond-dant-s-4342352.jpg" alt="User" class="object-cover w-12 h-12 rounded-full">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Sonira Roy</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Manager</p>
                            </div>
                        </div>
                        <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-400">Joined 12, SEP, 2022</p>
                    </div>
                    <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem cupiditate similique, iure minus sed fugit obcaecati minima quam reiciendis dicta!
                    </p>
                    <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                        <div class="flex px-6 mb-2 md:mb-0">
                            <ul class="flex items-center justify-start mr-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-blue-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                    </li>
                                @endfor
                            </ul>
                            <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating: <span class="font-semibold text-gray-600 dark:text-gray-300">5.0</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
