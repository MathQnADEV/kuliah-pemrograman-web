@extends('layouts.app')

@section('title', 'Profile - Pet Hotel & Adopt')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold">Profile Saya</h1>
                <p class="text-gray-600">Kelola informasi profil dan akun Anda</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-6">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar Profile -->
                <div class="lg:col-span-1">
                    <div class="card bg-base-100 shadow-lg">
                        <div class="card-body">
                            <!-- Profile Info -->
                            <div class="flex flex-col items-center mb-6">
                                <div class="avatar mb-4">
                                    <div class="w-24 rounded-full ring ring-primary ring-offset-2 ring-offset-base-100">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" />
                                        @else
                                            <div
                                                class="w-full h-full bg-primary flex items-center justify-center text-white text-3xl">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold">{{ Auth::user()->name }}</h3>
                                <p class="text-gray-500">{{ Auth::user()->email }}</p>
                                @if (Auth::user()->google_id)
                                    <div class="badge badge-primary mt-2">
                                        <i class="fab fa-google mr-1"></i> Google Account
                                    </div>
                                @endif
                            </div>

                            <!-- Account Info -->
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Member sejak</span>
                                    <span class="font-semibold">{{ Auth::user()->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Email Verifikasi</span>
                                    @if (Auth::user()->email_verified_at)
                                        <span class="badge badge-success badge-sm">
                                            <i class="fas fa-check-circle"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge badge-warning badge-sm">
                                            <i class="fas fa-clock"></i> Belum
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="card bg-base-100 shadow-lg mt-6">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Menu Cepat</h4>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('home') }}"
                                        class="flex items-center p-2 hover:bg-base-200 rounded">
                                        <i class="fas fa-tachometer-alt mr-3 text-primary"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.pet-hotel.index') }}"
                                        class="flex items-center p-2 hover:bg-base-200 rounded">
                                        <i class="fas fa-hotel mr-3 text-primary"></i>
                                        Pet Hotel Saya
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.adoption.index') }}"
                                        class="flex items-center p-2 hover:bg-base-200 rounded">
                                        <i class="fas fa-heart mr-3 text-primary"></i>
                                        Adopsi Saya
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Profile Information Section -->
                    <div class="card bg-base-100 shadow-lg mb-6">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="card-title text-xl">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    Informasi Profil
                                </h2>
                            </div>

                            <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Nama Lengkap *</span>
                                        </label>
                                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                            class="input input-bordered w-full @error('name') input-error @enderror"
                                            required />
                                        @error('name')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>

                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Email *</span>
                                        </label>
                                        <input type="email" name="email"
                                            value="{{ old('email', Auth::user()->email) }}"
                                            class="input input-bordered w-full @error('email') input-error @enderror"
                                            required />
                                        @error('email')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Nomor Telepon</span>
                                        </label>
                                        <input type="tel" name="phone"
                                            value="{{ old('phone', Auth::user()->phone) }}"
                                            class="input input-bordered w-full @error('phone') input-error @enderror"
                                            placeholder="081234567890" />
                                        @error('phone')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>

                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-semibold">Tanggal Lahir</span>
                                        </label>
                                        <input type="date" name="date_of_birth"
                                            value="{{ old('date_of_birth', Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('Y-m-d') : '') }}"
                                            class="input input-bordered w-full @error('date_of_birth') input-error @enderror" />
                                        @error('date_of_birth')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Alamat</span>
                                    </label>
                                    <textarea name="address" class="textarea textarea-bordered w-full @error('address') textarea-error @enderror"
                                        rows="3" placeholder="Alamat lengkap">{{ old('address', Auth::user()->address) }}</textarea>
                                    @error('address')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>

                                <div class="flex gap-3 mt-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('user.profile') }}" class="btn btn-ghost">
                                        Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="card bg-base-100 shadow-lg mb-6">
                        <div class="card-body">
                            <h2 class="card-title text-xl mb-6">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Keamanan Akun
                            </h2>

                            @if (!Auth::user()->google_id)
                                <!-- Change Password -->
                                <div>
                                    <h3 class="font-semibold mb-4">Ubah Password</h3>
                                    <form method="POST" action="{{ route('user.password.update') }}" class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text font-semibold">Password Saat Ini</span>
                                            </label>
                                            <div class="relative">
                                                <input type="password" name="current_password"
                                                    class="input input-bordered w-full pl-10 @error('current_password') input-error @enderror"
                                                    required />
                                                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                                            </div>
                                            @error('current_password')
                                                <label class="label">
                                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                                </label>
                                            @enderror
                                        </div>

                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text font-semibold">Password Baru</span>
                                            </label>
                                            <div class="relative">
                                                <input type="password" name="new_password"
                                                    class="input input-bordered w-full pl-10 @error('new_password') input-error @enderror"
                                                    required />
                                                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                                            </div>
                                            @error('new_password')
                                                <label class="label">
                                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                                </label>
                                            @enderror
                                        </div>

                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text font-semibold">Konfirmasi Password Baru</span>
                                            </label>
                                            <div class="relative">
                                                <input type="password" name="new_password_confirmation"
                                                    class="input input-bordered w-full pl-10" required />
                                                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-key mr-2"></i> Ubah Password
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Anda login menggunakan akun Google. Password diatur melalui Google.
                                </div>

                                <div class="mt-4">
                                    <h3 class="font-semibold mb-3">Koneksi Akun</h3>
                                    <div class="flex items-center justify-between p-3 border rounded-lg">
                                        <div class="flex items-center">
                                            <div class="bg-red-500 text-white p-2 rounded mr-3">
                                                <i class="fab fa-google"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold">Google</h4>
                                                <p class="text-sm text-gray-500">Akun Google terhubung</p>
                                            </div>
                                        </div>
                                        <div class="badge badge-success">
                                            <i class="fas fa-check mr-1"></i> Terhubung
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Account Actions Section -->
                    <div class="card bg-base-100 shadow-lg">
                        <div class="card-body">
                            <h2 class="card-title text-xl mb-6 text-error">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Aksi Akun
                            </h2>

                            <div class="space-y-4">
                                <!-- Delete Account -->
                                <div
                                    class="flex items-center justify-between p-4 border border-error/20 rounded-lg bg-error/5">
                                    <div>
                                        <h4 class="font-semibold text-error">Hapus Akun</h4>
                                        <p class="text-sm text-gray-500">Hapus permanen akun dan semua data Anda</p>
                                    </div>
                                    <button class="btn btn-error btn-outline" onclick="deleteAccount()">
                                        <i class="fas fa-trash mr-1"></i> Hapus Akun
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <dialog id="delete-account-modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Konfirmasi Penghapusan Akun</h3>
            <p class="py-4">
                Apakah Anda yakin ingin menghapus akun Anda?
                <span class="font-semibold text-error">Tindakan ini tidak dapat dibatalkan.</span>
                Semua data Anda akan dihapus secara permanen.
            </p>
            <div class="modal-action">
                <form method="POST" action="{{ route('user.account.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">
                        <i class="fas fa-trash mr-1"></i> Ya, Hapus Akun
                    </button>
                </form>
                <form method="dialog">
                    <button class="btn">Batal</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
@endsection

@section('scripts')
    <script>
        function deleteAccount() {
            document.getElementById('delete-account-modal').showModal();
        }

        // Auto-hide success message after 5 seconds
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        }, 5000);

        // Format phone number input
        const phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.startsWith('0')) {
                    value = value.substring(1);
                }
                if (value.length > 0) {
                    value = '0' + value;
                }
                e.target.value = value;
            });
        }
    </script>
@endsection
