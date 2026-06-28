<x-frontend-layout>
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex h-full items-center">
        <main class="w-full max-w-4xl mx-auto p-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">My Profile</h1>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Manage your account settings and preferences
                        </p>
                    </div>

                    <hr class="my-5 border-slate-300">

                    <!-- Display flash messages -->
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                            <ul class="list-disc pl-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Profile Sidebar -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 text-center">
                                <div class="relative inline-block">
                                    @if($user->avatar)
                                        <img src="{{ asset('uploads/avatars/' . $user->avatar) }}" 
                                             alt="{{ $user->name }}" 
                                             class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-white shadow-lg">
                                    @else
                                        <div class="w-24 h-24 rounded-full bg-blue-500 text-white flex items-center justify-center text-3xl font-bold mx-auto border-4 border-white shadow-lg">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    
                                    <!-- Avatar Upload Button -->
                                    <button type="button" onclick="document.getElementById('avatarUpload').click()" 
                                            class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </button>
                                    
                                    <form id="avatarForm" method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" class="hidden">
                                        @csrf
                                        <input type="file" id="avatarUpload" name="avatar" accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                                    </form>
                                </div>

                                <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                                
                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        <span class="block">Member since</span>
                                        <span class="font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Edit Forms -->
                        <div class="md:col-span-2 space-y-6">
                            <!-- Update Profile Form -->
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Update Profile</h3>
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="grid gap-4">
                                        <div>
                                            <label for="name" class="block text-sm mb-2 dark:text-white">Name</label>
                                            <input type="text" id="name" name="name" 
                                                   value="{{ old('name', $user->name) }}" 
                                                   class="py-2 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        </div>
                                        
                                        <div>
                                            <label for="email" class="block text-sm mb-2 dark:text-white">Email</label>
                                            <input type="email" id="email" name="email" 
                                                   value="{{ old('email', $user->email) }}" 
                                                   class="py-2 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        </div>
                                        
                                        <button type="submit" class="w-full py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                            Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Change Password Form -->
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Change Password</h3>
                                <form method="POST" action="{{ route('profile.password') }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="grid gap-4">
                                        <div>
                                            <label for="current_password" class="block text-sm mb-2 dark:text-white">Current Password</label>
                                            <input type="password" id="current_password" name="current_password" 
                                                   class="py-2 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        </div>
                                        
                                        <div>
                                            <label for="new_password" class="block text-sm mb-2 dark:text-white">New Password</label>
                                            <input type="password" id="new_password" name="new_password" 
                                                   class="py-2 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        </div>
                                        
                                        <div>
                                            <label for="new_password_confirmation" class="block text-sm mb-2 dark:text-white">Confirm New Password</label>
                                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                                   class="py-2 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        </div>
                                        
                                        <button type="submit" class="w-full py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 transition-all duration-200">
                                            Change Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</x-frontend-layout>