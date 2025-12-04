@extends('layouts.app')

@section('title', 'Detail Booking Pet Hotel - Pet Hotel & Adopt')

@section('styles')
    <style>
        .timeline {
            position: relative;
        }

        .timeline-item {
            position: relative;
        }

        .timeline-marker {
            position: absolute;
            left: 0;
        }

        .timeline-content {
            padding-bottom: 2rem;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header dengan navigasi -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <div class="flex items-center mb-2">
                    <a href="{{ route('user.pet-hotel.index') }}"
                        class="text-primary hover:text-primary-dark flex items-center mr-4">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <h1 class="text-2xl font-bold">Detail Booking Pet Hotel</h1>
                </div>
                <p class="text-gray-600">ID Booking: <span
                        class="font-semibold">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span></p>
            </div>

            <div class="flex gap-2">
                @if (in_array($booking->status, ['pending', 'confirmed']) && $booking->payment_status != 'paid')
                    <a href="{{ route('user.pet-hotel.payment', $booking->id) }}" class="btn btn-primary">
                        <i class="fas fa-credit-card mr-2"></i> Bayar Sekarang
                    </a>
                @endif

                @if (in_array($booking->status, ['confirmed', 'checked_in']))
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-map-marker-alt mr-2"></i> Tracking
                    </a>
                @endif
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info mb-6">
                <i class="fas fa-info-circle mr-2"></i>
                {{ session('info') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Informasi Utama -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Card Status dan Ringkasan -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                            <div>
                                <h2 class="card-title text-xl">{{ $booking->pet_name }}</h2>
                                <p class="text-gray-600">{{ $booking->pet_type }} • Tipe Kamar:
                                    {{ ucfirst($booking->room_type) }}</p>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <div
                                    class="badge badge-lg {{ $booking->status == 'pending' ? 'badge-warning' : ($booking->status == 'confirmed' ? 'badge-info' : ($booking->status == 'checked_in' ? 'badge-success' : ($booking->status == 'checked_out' ? 'badge-primary' : 'badge-error'))) }}">
                                    @if ($booking->status == 'pending')
                                        Menunggu Konfirmasi
                                    @elseif($booking->status == 'confirmed')
                                        Dikonfirmasi
                                    @elseif($booking->status == 'checked_in')
                                        Sedang Menginap
                                    @elseif($booking->status == 'checked_out')
                                        Selesai
                                    @else
                                        Dibatalkan
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Booking -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-semibold mb-2 text-gray-700">Tanggal Menginap</h3>
                                    <div class="flex items-center text-lg">
                                        <i class="fas fa-calendar-alt text-primary mr-3"></i>
                                        <div>
                                            <p class="font-medium">
                                                {{ \Carbon\Carbon::parse($booking->check_in)->translatedFormat('l, d F Y') }}
                                            </p>
                                            <p class="text-gray-600 text-sm">Check-in</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-lg mt-2">
                                        <i class="fas fa-calendar-check text-primary mr-3"></i>
                                        <div>
                                            <p class="font-medium">
                                                {{ \Carbon\Carbon::parse($booking->check_out)->translatedFormat('l, d F Y') }}
                                            </p>
                                            <p class="text-gray-600 text-sm">Check-out</p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="font-semibold mb-2 text-gray-700">Durasi Menginap</h3>
                                    <div class="flex items-center">
                                        <i class="fas fa-clock text-primary mr-3 text-xl"></i>
                                        <div>
                                            <p class="text-2xl font-bold">
                                                {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }}
                                                hari</p>
                                            <p class="text-gray-600 text-sm">Total menginap</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-semibold mb-2 text-gray-700">Status Pembayaran</h3>
                                    <div class="flex items-center">
                                        @if ($booking->payment_status == 'paid')
                                            <div class="badge badge-success gap-2">
                                                <i class="fas fa-check-circle"></i>
                                                Lunas
                                            </div>
                                            @if ($booking->payment_date)
                                                <p class="text-sm text-gray-600 ml-3">
                                                    Dibayar pada
                                                    {{ \Carbon\Carbon::parse($booking->payment_date)->translatedFormat('d M Y, H:i') }}
                                                </p>
                                            @endif
                                        @elseif($booking->payment_status == 'pending' || $booking->payment_status == 'unpaid')
                                            <div class="badge badge-warning gap-2">
                                                <i class="fas fa-clock"></i>
                                                Menunggu Pembayaran
                                            </div>
                                        @else
                                            <div class="badge badge-error gap-2">
                                                <i class="fas fa-exclamation-circle"></i>
                                                Belum Dibayar
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <h3 class="font-semibold mb-2 text-gray-700">Total Biaya</h3>
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave text-primary mr-3 text-xl"></i>
                                        <div>
                                            <p class="text-2xl font-bold text-primary">Rp
                                                {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                            @if ($booking->payment_status != 'paid')
                                                <p class="text-gray-600 text-sm">Belum termasuk pembayaran</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Informasi Hewan -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Informasi Hewan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Hewan</label>
                                    <p class="text-lg">{{ $booking->pet_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Hewan</label>
                                    <p class="text-lg">{{ $booking->pet_type }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Berat</label>
                                    <p class="text-lg">{{ $booking->pet_weight }} kg</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Temperamen</label>
                                    <p class="text-lg">{{ $booking->temprament ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Makanan</label>
                                    <p class="text-lg">
                                        @if ($booking->bring_own_food)
                                            <span class="badge badge-success">Bawa makanan sendiri</span>
                                        @else
                                            <span class="badge badge-info">Makanan dari pet hotel</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                                    <p class="text-lg">{{ $booking->user_notes ?? 'Tidak ada catatan' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Informasi Pemilik -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Informasi Pemilik</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
                                    <p class="text-lg">{{ $booking->owner_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-lg">{{ $booking->owner_email ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <p class="text-lg">{{ $booking->owner_phone }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <p class="text-lg">{{ $booking->owner_address ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan Admin -->
                @if ($booking->admin_notes)
                    <div class="card bg-base-100 shadow-lg border-l-4 border-blue-500">
                        <div class="card-body">
                            <h2 class="card-title mb-4 flex items-center">
                                <i class="fas fa-sticky-note text-blue-500 mr-2"></i>
                                Catatan dari Admin
                            </h2>
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-gray-700 whitespace-pre-line">{{ $booking->admin_notes }}</p>
                                @if ($booking->updated_at)
                                    <p class="text-sm text-gray-500 mt-2">
                                        Diperbarui:
                                        {{ \Carbon\Carbon::parse($booking->updated_at)->translatedFormat('d F Y, H:i') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan: Sidebar Aksi dan Info -->
            <div class="space-y-6">
                <!-- Card Aksi Cepat -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Aksi Cepat</h2>
                        <div class="space-y-3">
                            @if ($booking->payment_status != 'paid' && in_array($booking->status, ['pending', 'confirmed']))
                                <a href="{{ route('user.pet-hotel.payment', $booking->id) }}"
                                    class="btn btn-primary btn-block">
                                    <i class="fas fa-credit-card mr-2"></i> Bayar Sekarang
                                </a>
                            @endif

                            @if (in_array($booking->status, ['confirmed', 'checked_in']))
                                <a href="#"
                                    class="btn btn-success btn-block">
                                    <i class="fas fa-map-marker-alt mr-2"></i> Tracking Peliharaan
                                </a>
                            @endif

                            @if ($booking->status == 'pending')
                                <button class="btn btn-warning btn-block" onclick="cancelBooking()">
                                    <i class="fas fa-times mr-2"></i> Batalkan Booking
                                </button>
                            @endif

                            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20mau%20bertanya%20tentang%20booking%20pet%20hotel%20ID:%20{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}"
                                target="_blank" class="btn btn-outline btn-block">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi Admin Jika Ingin Ada Perubahan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ganti bagian Timeline dengan kode ini -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Status Booking</h2>
                        <div class="space-y-4">
                            @php
                                $steps = [
                                    'pending' => [
                                        'icon' => 'fas fa-clock',
                                        'label' => 'Menunggu Konfirmasi',
                                        'active' => in_array($booking->status, [
                                            'pending',
                                            'confirmed',
                                            'checked_in',
                                            'checked_out',
                                        ]),
                                        'completed' => !in_array($booking->status, ['pending']),
                                    ],
                                    'confirmed' => [
                                        'icon' => 'fas fa-check-circle',
                                        'label' => 'Dikonfirmasi',
                                        'active' => in_array($booking->status, [
                                            'confirmed',
                                            'checked_in',
                                            'checked_out',
                                        ]),
                                        'completed' => in_array($booking->status, ['checked_in', 'checked_out']),
                                    ],
                                    'checked_in' => [
                                        'icon' => 'fas fa-sign-in-alt',
                                        'label' => 'Check-in',
                                        'active' => in_array($booking->status, ['checked_in', 'checked_out']),
                                        'completed' => $booking->status == 'checked_out',
                                    ],
                                    'checked_out' => [
                                        'icon' => 'fas fa-sign-out-alt',
                                        'label' => 'Check-out',
                                        'active' => $booking->status == 'checked_out',
                                        'completed' => $booking->status == 'checked_out',
                                    ],
                                ];
                            @endphp

                            @foreach ($steps as $statusKey => $step)
                                <div class="flex items-center">
                                    <div class="shrink-0">
                                        @if ($step['completed'])
                                            <div
                                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-check text-white"></i>
                                            </div>
                                        @elseif($step['active'])
                                            <div
                                                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                                <i class="{{ $step['icon'] }} text-white"></i>
                                            </div>
                                        @else
                                            <div
                                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                                <i class="{{ $step['icon'] }} text-gray-500"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <p
                                            class="font-semibold {{ $step['active'] ? 'text-gray-800' : 'text-gray-400' }}">
                                            {{ $step['label'] }}
                                        </p>
                                        @if ($booking->status == $statusKey)
                                            <p class="text-sm text-gray-600">Status saat ini</p>
                                        @endif
                                    </div>
                                </div>

                                @if (!$loop->last)
                                    <div class="ml-5">
                                        <div class="h-6 w-0.5 bg-gray-200 ml-4"></div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Card Informasi Pet Hotel -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Informasi Pet Hotel</h2>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-3 mt-1"></i>
                                <div>
                                    <p class="font-medium">Lokasi</p>
                                    <p class="text-sm text-gray-600">Jl. Contoh No. 123, Kota Bandung</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-gray-400 mr-3 mt-1"></i>
                                <div>
                                    <p class="font-medium">Jam Operasional</p>
                                    <p class="text-sm text-gray-600">24 Jam (Setiap Hari)</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone-alt text-gray-400 mr-3 mt-1"></i>
                                <div>
                                    <p class="font-medium">Telepon</p>
                                    <p class="text-sm text-gray-600">(022) 123-4567</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Code untuk Check-in -->
                @if (in_array($booking->status, ['confirmed', 'checked_in']))
                    <div class="card bg-base-100 shadow-lg">
                        <div class="card-body">
                            <h2 class="card-title mb-4">QR Code Check-in</h2>
                            <div class="text-center">
                                <div class="bg-white p-4 inline-block rounded-lg border">
                                    <div class="w-48 h-48 bg-gray-100 rounded flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-gray-400 text-5xl mb-2">
                                                <i class="fas fa-qrcode"></i>
                                            </div>
                                            <p class="text-sm text-gray-500">QR Code Check-in</p>
                                            <p class="text-xs text-gray-400">ID:
                                                #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-3">
                                    Tunjukkan QR code ini saat check-in di pet hotel
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Pembatalan -->
    <div id="cancelModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Konfirmasi Pembatalan</h3>
            <p class="py-4">Apakah Anda yakin ingin membatalkan booking ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-action">
                <form action="{{ route('user.pet-hotel.cancel', $booking->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeCancelModal()" class="btn btn-outline">Batal</button>
                    <button type="submit" class="btn btn-error">Ya, Batalkan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function cancelBooking() {
            const modal = document.getElementById('cancelModal');
            modal.classList.add('modal-open');
        }

        function closeCancelModal() {
            const modal = document.getElementById('cancelModal');
            modal.classList.remove('modal-open');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('cancelModal');
            if (event.target == modal) {
                closeCancelModal();
            }
        }
    </script>
@endsection
