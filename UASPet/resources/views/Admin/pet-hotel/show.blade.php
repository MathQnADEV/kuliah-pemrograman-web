@extends('Admin.layoutsAdmin.app')

@section('title', 'Detail Booking #' . str_pad($booking->id, 6, '0', STR_PAD_LEFT))

@section('subtitle', 'Detail lengkap reservasi pet hotel')

@section('content')
    <div class="space-y-6">
        <!-- Header dengan Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <div class="flex items-center mb-2">
                    <a href="{{ route('admin.pet-hotel.index') }}"
                        class="text-blue-600 hover:text-blue-800 flex items-center mr-4">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <h1 class="text-2xl font-bold">Detail Booking Pet Hotel</h1>
                </div>
                <p class="text-gray-600">ID Booking: <span
                        class="font-semibold">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span></p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.pet-hotel.edit', $booking->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit mr-2"></i> Edit Booking
                </a>
                <button onclick="printBooking()" class="btn btn-outline">
                    <i class="fas fa-print mr-2"></i> Cetak
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Informasi Utama -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Card Status dan Ringkasan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $booking->pet_name }}</h2>
                            <p class="text-gray-600">{{ $booking->pet_type }} • Tipe Kamar:
                                {{ ucfirst($booking->room_type) }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <div
                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                            {{ $booking->status == 'pending'
                                ? 'bg-yellow-100 text-yellow-800'
                                : ($booking->status == 'confirmed'
                                    ? 'bg-blue-100 text-blue-800'
                                    : ($booking->status == 'checked_in'
                                        ? 'bg-green-100 text-green-800'
                                        : ($booking->status == 'checked_out'
                                            ? 'bg-gray-100 text-gray-800'
                                            : 'bg-red-100 text-red-800'))) }}">
                                @if ($booking->status == 'pending')
                                    <i class="fas fa-clock mr-2"></i> Menunggu Konfirmasi
                                @elseif($booking->status == 'confirmed')
                                    <i class="fas fa-check-circle mr-2"></i> Dikonfirmasi
                                @elseif($booking->status == 'checked_in')
                                    <i class="fas fa-home mr-2"></i> Sedang Menginap
                                @elseif($booking->status == 'checked_out')
                                    <i class="fas fa-sign-out-alt mr-2"></i> Selesai
                                @else
                                    <i class="fas fa-times mr-2"></i> Dibatalkan
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
                                    <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                                    <div>
                                        <p class="font-medium">
                                            {{ \Carbon\Carbon::parse($booking->check_in)->translatedFormat('l, d F Y') }}
                                        </p>
                                        <p class="text-gray-600 text-sm">Check-in</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-lg mt-2">
                                    <i class="fas fa-calendar-check text-blue-500 mr-3"></i>
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
                                    <i class="fas fa-clock text-blue-500 mr-3 text-xl"></i>
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
                                    <div
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $booking->payment_status == 'paid'
                                        ? 'bg-green-100 text-green-800'
                                        : ($booking->payment_status == 'partial'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                        @if ($booking->payment_status == 'paid')
                                            <i class="fas fa-check-circle mr-2"></i> Lunas
                                        @elseif($booking->payment_status == 'partial')
                                            <i class="fas fa-exclamation-circle mr-2"></i> Sebagian
                                        @else
                                            <i class="fas fa-times mr-2"></i> Belum Dibayar
                                        @endif
                                    </div>
                                    @if ($booking->payment_date)
                                        <p class="text-sm text-gray-600 ml-3">
                                            Dibayar pada
                                            {{ \Carbon\Carbon::parse($booking->payment_date)->translatedFormat('d M Y, H:i') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h3 class="font-semibold mb-2 text-gray-700">Total Biaya</h3>
                                <div class="flex items-center">
                                    <i class="fas fa-money-bill-wave text-blue-500 mr-3 text-xl"></i>
                                    <div>
                                        <p class="text-2xl font-bold text-blue-600">Rp
                                            {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                        @if ($booking->paid_amount > 0)
                                            <p class="text-gray-600 text-sm">
                                                Sudah dibayar: Rp {{ number_format($booking->paid_amount, 0, ',', '.') }}
                                                @if ($booking->paid_amount < $booking->total_price)
                                                    <br>
                                                    <span class="text-yellow-600">Kurang: Rp
                                                        {{ number_format($booking->total_price - $booking->paid_amount, 0, ',', '.') }}</span>
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Informasi Hewan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Hewan</h2>
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
                                <p class="text-lg">{{ $booking->temprament }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Makanan</label>
                                <p class="text-lg">

                                    @if ($booking->bring_own_food)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-utensils mr-1"></i> Bawa makanan sendiri
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-concierge-bell mr-1"></i> Makanan dari pet hotel
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                                <p class="text-lg">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $booking->room_type == 'standard'
                                        ? 'bg-gray-100 text-gray-800'
                                        : ($booking->room_type == 'premium'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-purple-100 text-purple-800') }}">
                                        {{ ucfirst($booking->room_type) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Informasi Pemilik -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pemilik</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
                                <p class="text-lg">{{ $booking->owner_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <p class="text-lg">{{ $booking->owner_phone }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">User Account</label>
                                @if ($booking->user)
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                            @if ($booking->user->avatar)
                                                <img src="{{ $booking->user->avatar }}" alt="{{ $booking->user->name }}"
                                                    class="h-8 w-8 rounded-full">
                                            @else
                                                <i class="fas fa-user text-gray-500"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $booking->user->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $booking->user->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-gray-500">Tidak ada akun user terkait</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Catatan</h2>
                    <div class="space-y-4">
                        @if ($booking->user_notes)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan dari User</label>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p class="text-gray-700 whitespace-pre-line">{{ $booking->user_notes }}</p>
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Admin</label>
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                @if ($booking->admin_notes)
                                    <p class="text-gray-700 whitespace-pre-line">{{ $booking->admin_notes }}</p>
                                @else
                                    <p class="text-gray-500 italic">Belum ada catatan admin</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Sidebar Aksi dan Info -->
            <div class="space-y-6">
                <!-- Card Aksi Cepat -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
                    <div class="space-y-3">
                        <!-- Update Status -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Update Status Booking</label>
                            <select id="statusSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>
                                    Check-in</option>
                                <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>
                                    Check-out</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            <button onclick="updateStatus()" class="btn btn-primary btn-block mt-2">
                                <i class="fas fa-sync-alt mr-2"></i> Update Status
                            </button>
                        </div>

                        <!-- Update Payment Status -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Update Status Pembayaran</label>
                            <select id="paymentStatusSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                                <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                                <option value="partial" {{ $booking->payment_status == 'partial' ? 'selected' : '' }}>
                                    Partial</option>
                                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid
                                </option>
                            </select>
                            <div class="mt-2 space-y-2">
                                <input type="number" id="paidAmount" placeholder="Jumlah dibayar (Rp)"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                    value="{{ $booking->paid_amount }}">
                                <button onclick="updatePaymentStatus()" class="btn btn-primary btn-block">
                                    <i class="fas fa-credit-card mr-2"></i> Update Pembayaran
                                </button>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <a href="{{ route('admin.pet-hotel.edit', $booking->id) }}"
                                class="btn btn-outline btn-block mb-2">
                                <i class="fas fa-edit mr-2"></i> Edit Lengkap
                            </a>

                            @if ($booking->payment_proof)
                                <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank"
                                    class="btn btn-outline btn-block mb-2">
                                    <i class="fas fa-receipt mr-2"></i> Lihat Bukti Bayar
                                </a>
                            @endif

                            <button class="btn btn-error btn-block" onclick="my_modal_1.showModal()">
                                <i class="fas fa-trash mr-2"></i> Hapus Booking
                            </button>
                            <dialog id="my_modal_1" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold">Delete Confirmation!</h3>
                                    <p class="py-4">Yakin mau dihapus booking dari
                                                        {{ $booking->pet_name }} ({{ $booking->pet_type }})?</p>
                                    <div class="modal-action">
                                        <form action="{{ route('admin.pet-hotel.destroy', $booking->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-error">Delete</button>
                                        </form>
                                        <form method="dialog">
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button class="btn">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>

                        </div>
                    </div>
                </div>

                <!-- Card Informasi Pembayaran -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pembayaran</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode Pembayaran</span>
                            <span class="font-medium">{{ $booking->payment_method ?: 'Belum dipilih' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Tagihan</span>
                            <span class="font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sudah Dibayar</span>
                            <span class="font-bold text-green-600">Rp
                                {{ number_format($booking->paid_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 pt-2">
                            <span class="text-gray-600">Sisa Pembayaran</span>
                            <span class="font-bold text-red-600">
                                Rp {{ number_format($booking->total_price - $booking->paid_amount, 0, ',', '.') }}
                            </span>
                        </div>

                        @if ($booking->payment_date)
                            <div class="pt-2 border-t border-gray-200">
                                <p class="text-sm text-gray-600">Terakhir pembayaran:</p>
                                <p class="text-sm font-medium">
                                    {{ \Carbon\Carbon::parse($booking->payment_date)->translatedFormat('d F Y, H:i') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card Timeline Status -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Status Booking</h2>
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
                                    'active' => in_array($booking->status, ['confirmed', 'checked_in', 'checked_out']),
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
                                <div class="flex-shrink-0">
                                    @if ($step['completed'])
                                        <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                                            <i class="fas fa-check text-white text-sm"></i>
                                        </div>
                                    @elseif($step['active'])
                                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center">
                                            <i class="{{ $step['icon'] }} text-white text-sm"></i>
                                        </div>
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                            <i class="{{ $step['icon'] }} text-gray-500 text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium {{ $step['active'] ? 'text-gray-800' : 'text-gray-400' }}">
                                        {{ $step['label'] }}
                                    </p>
                                </div>
                            </div>

                            @if (!$loop->last)
                                <div class="ml-4">
                                    <div class="h-6 w-0.5 bg-gray-200"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function printBooking() {
            window.print();
        }

        function updateStatus() {
            const status = document.getElementById('statusSelect').value;

            fetch('{{ route('admin.pet-hotel.update-status', $booking->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function updatePaymentStatus() {
            const paymentStatus = document.getElementById('paymentStatusSelect').value;
            const paidAmount = document.getElementById('paidAmount').value;

            if (paymentStatus === 'paid') {
                
            }

            fetch('{{ route('admin.pet-hotel.update-payment-status', $booking->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        payment_status: paymentStatus,
                        paid_amount: paidAmount
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
