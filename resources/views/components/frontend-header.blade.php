<header
    class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-3 md:py-0 dark:bg-gray-800 shadow-md">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between w-full md:w-auto">
                <a class="flex-none text-xl font-semibold dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="/" aria-label="Brand">DCodeMania</a>

                <!-- Mobile Menu Buttons -->
                <div class="flex items-center gap-2 md:hidden">
                    <!-- Cart Icon for Mobile -->
                    <a href="{{ route('cart.index') }}" class="relative p-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php
                            $cartCount = session()->get('cart', []);
                            $cartCount = array_sum(array_column($cartCount, 'quantity'));
                        @endphp
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Mobile Hamburger Menu Button -->
                    <button type="button"
                        class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-visible transition-all duration-300 basis-full grow md:block">
                <div class="overflow-visible">
                    <div
                        class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

                        <!-- Navigation Links -->
                        <a class="font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-500' }} py-3 md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/" aria-current="page">Home</a>
                        <a class="font-medium {{ request()->routeIs('category') ? 'text-blue-600' : 'text-gray-500' }} py-3 md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/categories" aria-current="page">Categories</a>
                        <a class="font-medium {{ request()->routeIs('products') ? 'text-blue-600' : 'text-gray-500' }} py-3 md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/products" aria-current="page">Products</a>

                        <!-- Desktop Cart -->
                        <a href="{{ route('cart.index') }}" class="relative py-3 md:py-6 hidden md:block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @php
                                $cartCount = session()->get('cart', []);
                                $cartCount = array_sum(array_column($cartCount, 'quantity'));
                            @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="cart-count absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>

                        <!-- Authentication Check - Improved Dropdown -->
                        @auth
                            <div class="relative group">
                                <button id="userDropdownButton" type="button"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-600 transition py-3 md:py-0">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset('uploads/avatars/' . Auth::user()->avatar) }}"
                                            alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-full object-cover border">
                                    @else
                                        <span
                                            class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    @endif

                                    <span class="hidden md:block font-medium">
                                        {{ Auth::user()->name }}
                                    </span>

                                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown - Drawer Style -->
                                <div id="userDropdown"
                                    class="fixed right-3 top-20 w-70 max-h-[45vh] overflow-y-auto bg-white rounded-2xl shadow-2xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 z-[99999]">

                                    <!-- Header with user info -->
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 rounded-t-2xl">
                                        <div class="flex items-center gap-4">
                                            @if (Auth::user()->avatar)
                                                <img src="{{ asset('uploads/avatars/' . Auth::user()->avatar) }}"
                                                    alt="{{ Auth::user()->name }}"
                                                    class="w-12 h-12 rounded-full object-cover border-2 border-white">
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-full bg-white/20 backdrop-blur text-white flex items-center justify-center text-xl font-bold border-2 border-white/30">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <p class="text-white font-semibold text-lg">
                                                    {{ Auth::user()->name }}
                                                </p>
                                                <p class="text-blue-100 text-sm">
                                                    {{ Auth::user()->email }}
                                                </p>
                                                <span
                                                    class="inline-block mt-1 px-2 py-0.5 bg-white/20 text-white text-xs rounded-full">
                                                    Member since {{ Auth::user()->created_at->format('M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Menu Items -->
                                    <div class="p-3">
                                        <p
                                            class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider px-3 py-2">
                                            Account Settings
                                        </p>

                                        <a href="{{ route('profile') }}"
                                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group/item">
                                            <div
                                                class="w-5 h-5 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover/item:bg-blue-100 dark:group-hover/item:bg-blue-800/30 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-800 dark:text-white">My Account</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Manage your profile
                                                    settings</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('orders') }}"
                                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group/item">
                                            <div
                                                class="w-5 h-5 rounded-lg bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 flex items-center justify-center group-hover/item:bg-green-100 dark:group-hover/item:bg-green-800/30 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-800 dark:text-white">My Orders</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">View your order history
                                                </p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <div class="my-2 border-t border-gray-200 dark:border-gray-700"></div>

                                        <p
                                            class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider px-3 py-2">
                                            Support
                                        </p>

                                        <a href="#"
                                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group/item">
                                            <div
                                                class="w-5 h-5 rounded-lg bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover/item:bg-purple-100 dark:group-hover/item:bg-purple-800/30 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-800 dark:text-white">Help Center</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Get support and FAQ</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <div class="my-2 border-t border-gray-200 dark:border-gray-700"></div>

                                        <!-- Logout Button -->
                                        <form action="{{ route('logout') }}" method="POST" class="p-1">
                                            @csrf
                                            <button
                                                class="flex items-center gap-4 w-full p-3 rounded-xl text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition group/item">
                                                <div
                                                    class="w-5 h-5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 flex items-center justify-center group-hover/item:bg-red-100 dark:group-hover/item:bg-red-800/30 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 text-left">
                                                    <p class="font-medium">Logout</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Sign out of your
                                                        account</p>
                                                </div>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Login
                            </a>

                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Drawer Navigation (Hidden on Desktop) -->
<div id="drawer-navigation"
    class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 md:hidden"
    tabindex="-1" aria-labelledby="drawer-navigation-label">
    <div class="border-b border-gray-200 dark:border-gray-700 pb-4 flex items-center justify-between">
        <a href="/" class="flex items-center space-x-2 rtl:space-x-reverse">
            <span
                class="self-center text-xl font-semibold whitespace-nowrap text-gray-800 dark:text-white">DCodeMania</span>
        </a>
        <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
            class="text-gray-400 bg-transparent hover:text-gray-900 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <div class="py-5 overflow-y-auto">
        <!-- User Info in Drawer -->
        @auth
            <div class="flex items-center gap-3 mb-4 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div
                    class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-semibold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                </div>
            </div>
        @endauth

        <ul class="space-y-2 font-medium">
            <li>
                <a href="/"
                    class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="/categories"
                    class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 {{ request()->routeIs('category') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="ms-3">Categories</span>
                </a>
            </li>
            <li>
                <a href="/products"
                    class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 {{ request()->routeIs('products') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="ms-3">Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cart.index') }}"
                    class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="ms-3">Cart</span>
                    @php
                        $cartCount = session()->get('cart', []);
                        $cartCount = array_sum(array_column($cartCount, 'quantity'));
                    @endphp
                    @if ($cartCount > 0)
                        <span
                            class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-medium text-white bg-red-500 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </li>

            @auth
                <li>
                    <a href="{{ route('profile') }}"
                        class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="ms-3">My Account</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders') }}"
                        class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="ms-3">My Orders</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-3 py-2 text-red-600 rounded-lg hover:bg-red-50 dark:text-red-500 dark:hover:bg-red-900/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="ms-3">Logout</span>
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}"
                        class="flex items-center px-3 py-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span class="ms-3">Sign In</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}"
                        class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="ms-3">Sign Up</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle navigation collapse for mobile
            const toggleButtons = document.querySelectorAll('[data-hs-collapse]');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-hs-collapse');
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.classList.toggle('hidden');
                    }
                });
            });

            // Drawer functionality for mobile
            const drawer = document.getElementById('drawer-navigation');
            const drawerToggleButtons = document.querySelectorAll('[data-drawer-target="drawer-navigation"]');
            const drawerHideButtons = document.querySelectorAll('[data-drawer-hide="drawer-navigation"]');

            // Show drawer
            drawerToggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (drawer) {
                        drawer.classList.remove('-translate-x-full');
                        document.body.style.overflow = 'hidden';
                    }
                });
            });

            // Hide drawer
            drawerHideButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (drawer) {
                        drawer.classList.add('-translate-x-full');
                        document.body.style.overflow = '';
                    }
                });
            });

            // Close drawer when clicking outside
            drawer?.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('-translate-x-full');
                    document.body.style.overflow = '';
                }
            });

            // Close drawer with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && drawer && !drawer.classList.contains('-translate-x-full')) {
                    drawer.classList.add('-translate-x-full');
                    document.body.style.overflow = '';
                }
            });

            // Click functionality for dropdown
            const dropdownButton = document.getElementById('userDropdownButton');
            const dropdown = document.getElementById('userDropdown');

            if (dropdownButton && dropdown) {
                dropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isVisible = dropdown.classList.contains('opacity-100');

                    if (isVisible) {
                        dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
                        dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                    } else {
                        dropdown.classList.remove('opacity-0', 'invisible', 'scale-95');
                        dropdown.classList.add('opacity-100', 'visible', 'scale-100');
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!dropdownButton.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
                        dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                    }
                });

                // Close dropdown on Escape key
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
                        dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                    }
                });
            }
        });
    </script>
@endpush
