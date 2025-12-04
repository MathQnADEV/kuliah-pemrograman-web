<aside class="sidebar w-64 text-gray-700 fixed lg:relative h-full z-40 border-r border-gray-200">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="avatar">
                        @if(Auth::user()->avatar)
                            <div class="w-12 rounded-full ring-2 ring-gray-200 ring-offset-2">
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white flex items-center justify-center ring-2 ring-blue-100">
                                <i class="fas fa-user text-xl"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-800">Pet Hotel Admin</h2>
                        <p class="text-sm text-gray-500">
                            {{ Auth::user()->name }}
                            <br>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ Auth::user()->is_admin ? 'Administrator' : 'User' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'hover:border-l-4 hover:border-blue-200' }}">
                    <i class="fas fa-home w-5 text-gray-500 {{ request()->routeIs('admin.dashboard') ? 'text-blue-500' : '' }}"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.pet-hotel.index') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.pet-hotel.index') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'hover:border-l-4 hover:border-blue-200' }}">
                    <i class="fas fa-hotel w-5 text-gray-500 {{ request()->routeIs('admin.pet-hotel.index') ? 'text-blue-500' : '' }}"></i>
                    <span class="font-medium">Pet Hotel</span>
                </a>

                <a href="{{ route('admin.adoption-pets.index') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.adoption-pets.index') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'hover:border-l-4 hover:border-blue-200' }}">
                    <i class="fas fa-paw w-5 text-gray-500 {{ request()->routeIs('admin.adoption-pets.index') ? 'text-blue-500' : '' }}"></i>
                    <span class="font-medium">Hewan Adopsi</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.users.index') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'hover:border-l-4 hover:border-blue-200' }}">
                    <i class="fas fa-users w-5 text-gray-500 {{ request()->routeIs('admin.users.index') ? 'text-blue-500' : '' }}"></i>
                    <span class="font-medium">Pengguna</span>
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 hover:bg-red-50 hover:text-red-600 w-full text-left">
                        <i class="fas fa-sign-out-alt w-5 text-gray-500"></i>
                        <span class="font-medium">Keluar</span>
                    </button>
                </form>
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-circle text-green-500 mr-1"></i>
                        <span>Online</span>
                    </div>
                    <div class="text-xs text-gray-400">
                        v1.0.0
                    </div>
                </div>
            </div>
        </aside>
