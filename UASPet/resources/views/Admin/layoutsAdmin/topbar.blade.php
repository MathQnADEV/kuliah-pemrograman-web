<header class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <div class="flex items-center space-x-2">
                            <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                            @if(Auth::user()->is_admin)
                            <span class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-shield-alt mr-1"></i> Admin
                            </span>
                            @endif
                        </div>
                        <p class="text-gray-600 text-sm mt-1">@yield('subtitle', Auth::user()->is_admin ? 'Selamat datang di panel admin' : 'Selamat datang di dashboard')</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <!-- Date Display -->
                        <div class="hidden md:block bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar text-gray-500"></i>
                                <span class="text-sm font-medium text-gray-700">{{ now()->translatedFormat('l, d F Y') }}</span>
                            </div>
                        </div>

                        <!-- User Profile -->
                        <div class="dropdown dropdown-end">
                            <label tabindex="0" class="btn btn-ghost btn-circle avatar hover:bg-gray-100">
                                <div class="w-10 rounded-full ring-2 ring-gray-200 ring-offset-2">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="Profile" />
                                    @else
                                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow-lg bg-white border border-gray-200 rounded-box w-52 mt-2">
                                <li class="border-b border-gray-100">
                                    <div class="px-4 py-3">
                                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ Auth::user()->is_admin ? '#' : route('user.profile') }}" class="text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-user-circle mr-2 text-gray-500"></i>
                                        Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-cog mr-2 text-gray-500"></i>
                                        Pengaturan
                                    </a>
                                </li>
                                <li class="border-t border-gray-100 mt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left text-red-600 hover:bg-red-50">
                                            <i class="fas fa-sign-out-alt mr-2"></i>
                                            Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
