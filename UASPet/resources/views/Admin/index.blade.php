@extends('Admin.layoutsAdmin.app')

@section('title', 'Dashboard Admin')

@section('subtitle', 'Ringkasan dan statistik sistem')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-linear-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-gray-600">Kelola Pet Hotel dan Adopsi hewan.</p>
            </div>
        </div>
    </div>

    <!-- Stats Grid - Pet Hotel & Adopsi -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Reservasi (Pet Hotel) -->
        <div class="stat-card rounded-xl shadow-sm border border-gray-200 p-5 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-lg bg-blue-50">
                    <i class="fas fa-hotel text-blue-500 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $stats['total_bookings'] ?? 0 }}</h3>
            <p class="text-gray-600 text-sm">Total Reservasi</p>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ $stats['pending_bookings'] ?? 0 }} menunggu</span>
                </div>
            </div>
        </div>

        <!-- Hewan Aktif di Hotel -->
        <div class="stat-card rounded-xl shadow-sm border border-gray-200 p-5 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-lg bg-green-50">
                    <i class="fas fa-paw text-green-500 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $stats['active_bookings'] ?? 0 }}</h3>
            <p class="text-gray-600 text-sm">Hewan di Hotel</p>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-home mr-2"></i>
                    <span>Sedang menginap</span>
                </div>
            </div>
        </div>

        <!-- Total Hewan Adopsi -->
        <div class="stat-card rounded-xl shadow-sm border border-gray-200 p-5 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-lg bg-purple-50">
                    <i class="fas fa-heart text-purple-500 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $stats['total_adoptions'] ?? 0 }}</h3>
            <p class="text-gray-600 text-sm">Total Adopsi</p>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-heartbeat mr-2"></i>
                    <span>{{ $stats['pending_adoptions'] ?? 0 }} menunggu</span>
                </div>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="stat-card rounded-xl shadow-sm border border-gray-200 p-5 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-lg bg-orange-50">
                    <i class="fas fa-users text-orange-500 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $stats['total_users'] ?? 0 }}</h3>
            <p class="text-gray-600 text-sm">Total Pengguna</p>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-user-friends mr-2"></i>
                    <span>Terdaftar</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pet Hotel & Adopsi Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Today's Pet Hotel Stats -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-linear-to-r from-blue-50 to-white">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-blue-100 mr-3">
                        <i class="fas fa-hotel text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Pet Hotel Hari Ini</h2>
                        <p class="text-gray-600 text-sm">Ringkasan aktivitas harian</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $stats['today_checkins'] ?? 0 }}</div>
                        <p class="text-sm text-gray-600">Check-in</p>
                        <div class="mt-2 text-xs text-blue-500">
                            <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                        </div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-3xl font-bold text-green-600 mb-2">{{ $stats['today_checkouts'] ?? 0 }}</div>
                        <p class="text-sm text-gray-600">Check-out</p>
                        <div class="mt-2 text-xs text-green-500">
                            <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-600">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ now()->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adoption Progress -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-linear-to-r from-purple-50 to-white">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-purple-100 mr-3">
                        <i class="fas fa-heart text-purple-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Progress Adopsi</h2>
                        <p class="text-gray-600 text-sm">Status data adopsi</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Tersedia</span>
                            <span class="font-medium text-purple-600">{{ $stats['available_adoptions'] ?? 0 }} hewan</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $stats['available_adoptions_percentage'] ?? 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Menunggu Status</span>
                            <span class="font-medium text-yellow-600">{{ $stats['pending_adoptions'] ?? 0 }} hewan</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $stats['pending_adoptions_percentage'] ?? 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Berhasil Diadopsi</span>
                            <span class="font-medium text-green-600">{{ $stats['adopted_adoptions'] ?? 0 }} hewan</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['adopted_adoptions_percentage'] ?? 0 }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                    <a href="{{ route('admin.adoption-pets.index') }}" class="text-purple-600 hover:text-purple-800 font-medium">
                        Lihat Semua Pengajuan <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Recent Reservations Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden card-hover">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-blue-100 mr-3">
                                <i class="fas fa-hotel text-blue-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Reservasi Terbaru</h2>
                                <p class="text-gray-600 text-sm mt-1">Daftar reservasi pet hotel yang baru masuk</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.pet-hotel.index') }}" class="mt-3 sm:mt-0 text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center">
                            Lihat Semua
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                @if(isset($recentBookings) && $recentBookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID & Pemilik
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Hewan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentBookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user text-gray-500"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->owner_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->pet_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->pet_type }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }} hari</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->status == 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> Pending
                                            </span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-check-circle mr-1"></i> Confirmed
                                            </span>
                                        @elseif($booking->status == 'checked_in')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-home mr-1"></i> Check-in
                                            </span>
                                        @elseif($booking->status == 'checked_out')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-sign-out-alt mr-1"></i> Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times mr-1"></i> Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.pet-hotel.show', $booking->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4">
                            <i class="fas fa-hotel text-2xl text-blue-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada reservasi</h3>
                        <p class="text-gray-500 max-w-sm mx-auto">Tidak ada data reservasi pet hotel yang tersedia saat ini.</p>
                    </div>
                @endif

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Menampilkan {{ min($recentBookings->count() ?? 0, 5) }} dari {{ $stats['total_bookings'] ?? 0 }} reservasi
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
