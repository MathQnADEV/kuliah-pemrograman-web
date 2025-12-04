<h3 class="text-xl font-bold mb-4">Detail Pengguna</h3>

<div class="flex flex-col md:flex-row gap-6 mb-6">
    <!-- Profile Picture -->
    <div class="flex-shrink-0">
        @if($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                 class="w-32 h-32 rounded-full ring-4 ring-gray-200 object-cover">
        @else
            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white flex items-center justify-center ring-4 ring-blue-100">
                <i class="fas fa-user text-4xl"></i>
            </div>
        @endif
    </div>

    <!-- User Info -->
    <div class="flex-1">
        <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->name }}</h4>

        <div class="space-y-3">
            <div>
                <span class="font-semibold text-gray-700">Email:</span>
                <span class="ml-2">{{ $user->email }}</span>
                @if($user->email_verified_at)
                    <span class="ml-2 badge badge-success">
                        <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                    </span>
                @endif
            </div>

            <div>
                <span class="font-semibold text-gray-700">Role:</span>
                @if($user->is_admin)
                    <span class="ml-2 badge badge-primary">
                        <i class="fas fa-shield-alt mr-1"></i> Administrator
                    </span>
                @else
                    <span class="ml-2 badge badge-success">
                        <i class="fas fa-user mr-1"></i> User
                    </span>
                @endif
            </div>

            <div>
                <span class="font-semibold text-gray-700">Login Method:</span>
                @if($user->google_id)
                    <span class="ml-2 flex items-center">
                        <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google" class="w-5 h-5 mr-2">
                        Google OAuth ({{ $user->google_id }})
                    </span>
                @else
                    <span class="ml-2 flex items-center">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                        Email & Password
                    </span>
                @endif
            </div>

            <div>
                <span class="font-semibold text-gray-700">Terdaftar:</span>
                <span class="ml-2">{{ $user->created_at->format('d F Y H:i') }}</span>
                <span class="text-gray-500 text-sm ml-2">({{ $user->created_at->diffForHumans() }})</span>
            </div>

            @if($user->phone)
            <div>
                <span class="font-semibold text-gray-700">Telepon:</span>
                <span class="ml-2">{{ $user->phone }}</span>
            </div>
            @endif

            @if($user->date_of_birth)
            <div>
                <span class="font-semibold text-gray-700">Tanggal Lahir:</span>
                <span class="ml-2">{{ $user->date_of_birth->format('d F Y') }}</span>
                <span class="text-gray-500 text-sm ml-2">({{ now()->diffInYears($user->date_of_birth) }} tahun)</span>
            </div>
            @endif

            @if($user->address)
            <div>
                <span class="font-semibold text-gray-700">Alamat:</span>
                <p class="ml-2 mt-1 text-gray-600">{{ $user->address }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    <div class="stat bg-base-200 rounded-lg p-4">
        <div class="stat-title">ID Pengguna</div>
        <div class="stat-value text-lg font-mono">{{ $user->id }}</div>
    </div>

    <div class="stat bg-base-200 rounded-lg p-4">
        <div class="stat-title">Terakhir Diupdate</div>
        <div class="stat-value text-lg">{{ $user->updated_at->format('d M Y') }}</div>
    </div>

    <div class="stat bg-base-200 rounded-lg p-4">
        <div class="stat-title">Provider</div>
        <div class="stat-value text-lg">
            @if($user->google_id)
                Google
            @else
                Email
            @endif
        </div>
    </div>
</div>

<div class="alert alert-info">
    <div class="flex items-center">
        <i class="fas fa-info-circle mr-2"></i>
        <span>
            Data pengguna ini diambil dari database. Pengguna yang login dengan Google tidak memiliki password di sistem.
        </span>
    </div>
</div>
