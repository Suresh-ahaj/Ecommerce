<x-frontend-layout>
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            Welcome back, {{ Auth::user()->name }}!
        </p>
        <div class="mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
</x-frontend-layout>
