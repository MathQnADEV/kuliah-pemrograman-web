<nav class="navbar bg-base-100 shadow-lg sticky top-0 z-50">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('pet-hotel.public') }}">Pet Hotel</a></li>
                <li><a href="{{ route('adoption.public') }}">Adopsi</a></li>

                @auth
                    <!-- Menu khusus user yang sudah login -->
                    <li><hr class="my-1"></li>
                    <li><a href="{{ route('user.pet-hotel.index') }}">Pet Hotel Saya</a></li>
                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                @endauth
            </ul>
        </div>
        <a class="btn btn-ghost text-xl text-primary" href="{{ route('home') }}">
            <i class="fas fa-paw mr-2"></i>
            Pet Hotel & Adopt
        </a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('pet-hotel.public') }}">Pet Hotel</a></li>
            <li><a href="{{ route('adoption.public') }}">Adopsi</a></li>
        </ul>
    </div>

    <div class="navbar-end">
        @auth
            <!-- User sudah login: Tampilkan dropdown profile -->
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full bg-primary flex items-center justify-center text-white">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" />
                        @else
                            <span class="font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        @endif
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li class="p-3">
                        <div class="font-bold">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </li>
                    <li><hr class="my-1"></li>
                    <li><a href="{{ route('user.pet-hotel.index') }}"><i class="fas fa-hotel mr-2"></i> Pet Hotel Saya</a></li>
                    <li><a href="{{ route('user.profile') }}"><i class="fas fa-user mr-2"></i> Profile</a></li>
                    <li><hr class="my-1"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="w-full text-left">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <!-- User belum login: Tampilkan tombol login -->
            <a class="btn btn-primary" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </a>
        @endauth
    </div>
</nav>
