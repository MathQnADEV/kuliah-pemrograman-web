@extends('layouts.app')

@section('title', 'Pet Hotel Saya - Pet Hotel & Adopt')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold">Pet Hotel Saya</h1>
                <p class="text-gray-600">Kelola semua reservasi pet hotel Anda</p>
            </div>
            <a href="{{ route('user.pet-hotel.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i> Reservasi Baru
            </a>
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

        <!-- Filter Tabs -->
        <div class="tabs mb-6">
            <a class="tab tab-bordered {{ request('status') == null ? 'tab-active' : '' }}"
               href="{{ route('user.pet-hotel.index') }}">
                Semua ({{ $bookings->count() }})
            </a>
            <a class="tab tab-bordered {{ request('status') == 'pending' ? 'tab-active' : '' }}"
               href="{{ route('user.pet-hotel.index', ['status' => 'pending']) }}">
                Pending
            </a>
            <a class="tab tab-bordered {{ request('status') == 'confirmed' ? 'tab-active' : '' }}"
               href="{{ route('user.pet-hotel.index', ['status' => 'confirmed']) }}">
                Dikonfirmasi
            </a>
            <a class="tab tab-bordered {{ request('status') == 'checked_in' ? 'tab-active' : '' }}"
               href="{{ route('user.pet-hotel.index', ['status' => 'checked_in']) }}">
                Check-in
            </a>
            <a class="tab tab-bordered {{ request('status') == 'checked_out' ? 'tab-active' : '' }}"
               href="{{ route('user.pet-hotel.index', ['status' => 'checked_out']) }}">
                Selesai
            </a>
            <a class="tab tab-bordered {{ request('status') == 'cancelled' ? 'tab-active' : '' }}"
               href="{{ route('user.pet-hotel.index', ['status' => 'cancelled']) }}">
                Dibatalkan
            </a>
        </div>

        @if($bookings->isEmpty())
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-paw"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Belum Ada Reservasi</h3>
                <p class="text-gray-600 mb-6">Mulai buat reservasi pertama Anda untuk hewan peliharaan kesayangan</p>
                <a href="{{ route('user.pet-hotel.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Buat Reservasi Pertama
                </a>
            </div>
        @else
            <!-- Tampilkan jumlah booking -->
            <div class="mb-4 text-gray-600">
                Menampilkan {{ $bookings->count() }} reservasi
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($bookings as $booking)
                    <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-body">
                            <!-- Header dengan status -->
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="card-title text-lg font-bold">{{ $booking->pet_name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $booking->pet_type }} • {{ $booking->room_type }}</p>
                                </div>
                                <div class="badge {{ $booking->status == 'pending' ? 'badge-warning' : ($booking->status == 'confirmed' ? 'badge-info' : ($booking->status == 'checked_in' ? 'badge-success' : ($booking->status == 'checked_out' ? 'badge-primary' : 'badge-error'))) }}">
                                    @if($booking->status == 'pending')
                                        Menunggu
                                    @elseif($booking->status == 'confirmed')
                                        Dikonfirmasi
                                    @elseif($booking->status == 'checked_in')
                                        Check-in
                                    @elseif($booking->status == 'checked_out')
                                        Selesai
                                    @else
                                        Dibatalkan
                                    @endif
                                </div>
                            </div>

                            <!-- Informasi Booking -->
                            <div class="space-y-3 mb-4">
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-calendar-alt text-gray-400 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-medium">Tanggal Menginap</p>
                                        <p class="text-gray-600">
                                            {{ \Carbon\Carbon::parse($booking->check_in)->translatedFormat('d M Y') }}
                                            -
                                            {{ \Carbon\Carbon::parse($booking->check_out)->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center text-sm">
                                    <i class="fas fa-clock text-gray-400 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-medium">Durasi</p>
                                        <p class="text-gray-600">
                                            {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }} hari
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center text-sm">
                                    <i class="fas fa-weight text-gray-400 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-medium">Berat Hewan</p>
                                        <p class="text-gray-600">{{ $booking->pet_weight }} kg</p>
                                    </div>
                                </div>

                                @if($booking->temprament)
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-heart text-gray-400 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-medium">Temperamen</p>
                                        @if($booking->temprament == 'tenang')
                                            <p class="text-gray-600">Tenang dan pendiam</p>
                                        @elseif($booking->temprament == 'aktif')
                                            <p class="text-gray-600">Aktif dan energik</p>
                                        @elseif($booking->temprament == 'sangat_aktif')
                                            <p class="text-gray-600">Sangat aktif dan lincah</p>
                                        @elseif($booking->temprament == 'pemalu')
                                            <p class="text-gray-600">Pemalu dan sensitif</p>
                                        @elseif($booking->temprament == 'agresif')
                                            <p class="text-gray-600">Agresif/butuh perhatian khusus</p>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @if($booking->bring_food)
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-utensils text-gray-400 mr-3 w-5"></i>
                                    <div>
                                        <p class="font-medium">Makanan</p>
                                        <p class="text-gray-600">Bawa makanan sendiri</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Footer dengan harga dan aksi -->
                            <div class="card-actions justify-between items-center mt-4 pt-4 border-t">
                                <div>
                                    <p class="text-sm text-gray-500">Total Biaya</p>
                                    <p class="text-xl font-bold text-primary">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('user.pet-hotel.show', $booking->id) }}"
                                       class="btn btn-sm btn-outline">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </a>
                                </div>
                            </div>

                            <!-- Payment Status -->
                            @if($booking->payment_status == 'pending' || $booking->payment_status == 'unpaid')
                                <div class="mt-3 p-2 bg-yellow-50 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                                            <span class="text-sm font-medium text-yellow-700">
                                                Menunggu Pembayaran
                                            </span>
                                        </div>
                                        <button class="btn btn-xs btn-warning">
                                            <a href="{{ route('user.pet-hotel.payment', $booking->id) }}"
                                               class="text-white">
                                                Bayar Sekarang
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            @elseif($booking->payment_status == 'paid')
                                <div class="mt-3 p-2 bg-green-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        <span class="text-sm font-medium text-green-700">
                                            Pembayaran Lunas
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <!-- Admin Notes (jika ada) -->
                            @if($booking->admin_notes && $booking->status != 'pending')
                                <div class="mt-3 p-2 bg-blue-50 rounded-lg">
                                    <div class="flex items-start">
                                        <i class="fas fa-sticky-note text-blue-500 mr-2 mt-1"></i>
                                        <span class="text-sm text-blue-700">
                                            <strong>Catatan Admin:</strong> {{ Str::limit($booking->admin_notes, 80) }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Filter by status
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                const status = this.getAttribute('href').split('status=')[1];
                if(status) {
                    // Filter akan dilakukan melalui URL parameter
                }
            });
        });
    });
</script>
@endpush
