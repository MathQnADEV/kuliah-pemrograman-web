@extends('Admin.layoutsAdmin.app')

@section('title', 'Kelola Pet Hotel')

@section('subtitle', 'Daftar Reservasi Pet Hotel')

@section('content')
    <div class="space-y-6">
        <!-- Header dengan Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
            <a href="{{ route('admin.pet-hotel.index') }}"
                class="stat-card {{ !request('status') ? 'border-blue-500 bg-blue-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
                <div class="text-sm text-gray-600">Total</div>
            </a>
            <a href="{{ route('admin.pet-hotel.index', ['status' => 'pending']) }}"
                class="stat-card {{ request('status') == 'pending' ? 'border-yellow-500 bg-yellow-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['pending'] }}</div>
                <div class="text-sm text-gray-600">Pending</div>
            </a>
            <a href="{{ route('admin.pet-hotel.index', ['status' => 'confirmed']) }}"
                class="stat-card {{ request('status') == 'confirmed' ? 'border-blue-500 bg-blue-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['confirmed'] }}</div>
                <div class="text-sm text-gray-600">Confirmed</div>
            </a>
            <a href="{{ route('admin.pet-hotel.index', ['status' => 'checked_in']) }}"
                class="stat-card {{ request('status') == 'checked_in' ? 'border-green-500 bg-green-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['checked_in'] }}</div>
                <div class="text-sm text-gray-600">Check-in</div>
            </a>
            <a href="{{ route('admin.pet-hotel.index', ['status' => 'checked_out']) }}"
                class="stat-card {{ request('status') == 'checked_out' ? 'border-gray-500 bg-gray-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['checked_out'] }}</div>
                <div class="text-sm text-gray-600">Check-out</div>
            </a>
            <a href="{{ route('admin.pet-hotel.index', ['status' => 'cancelled']) }}"
                class="stat-card {{ request('status') == 'cancelled' ? 'border-red-500 bg-red-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['cancelled'] }}</div>
                <div class="text-sm text-gray-600">Cancelled</div>
            </a>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="GET" action="{{ route('admin.pet-hotel.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Booking</label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                            <option value="checked_in" {{ request('status') == 'checked_in' ? 'selected' : '' }}>Check-in
                            </option>
                            <option value="checked_out" {{ request('status') == 'checked_out' ? 'selected' : '' }}>
                                Check-out</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                        <select name="payment_status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all" {{ request('payment_status') == 'all' ? 'selected' : '' }}>Semua Status
                            </option>
                            <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid
                            </option>
                            <option value="partial" {{ request('payment_status') == 'partial' ? 'selected' : '' }}>Partial
                            </option>
                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="flex space-x-2">
                        <button type="submit" class="btn btn-primary px-6">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                        <a href="{{ route('admin.pet-hotel.index') }}" class="btn btn-outline">
                            <i class="fas fa-times mr-2"></i> Reset
                        </a>
                    </div>
                    <a href="{{ route('user.pet-hotel.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i> Tambah Booking
                    </a>
                </div>
            </form>
        </div>

        <!-- Daftar Booking -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Reservasi</h2>
                <p class="text-gray-600 text-sm mt-1">Menampilkan {{ $bookings->total() }} reservasi</p>
            </div>

            @if ($bookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID & Pemilik
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hewan & Kamar
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal & Durasi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pembayaran
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user text-gray-500"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->owner_name }}</div>
                                                <div class="text-xs text-gray-400">
                                                    {{ $booking->user ? $booking->user->email : 'User tidak ditemukan' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->pet_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->pet_type }} •
                                            {{ ucfirst($booking->room_type) }}</div>
                                        <div class="text-xs text-gray-400">{{ $booking->pet_weight }} kg</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }}
                                            hari
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
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
                                                <i class="fas fa-clock mr-1"></i> Pending
                                            @elseif($booking->status == 'confirmed')
                                                <i class="fas fa-check-circle mr-1"></i> Confirmed
                                            @elseif($booking->status == 'checked_in')
                                                <i class="fas fa-home mr-1"></i> Check-in
                                            @elseif($booking->status == 'checked_out')
                                                <i class="fas fa-sign-out-alt mr-1"></i> Check-out
                                            @else
                                                <i class="fas fa-times mr-1"></i> Cancelled
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col space-y-1">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $booking->payment_status == 'paid'
                                            ? 'bg-green-100 text-green-800'
                                            : ($booking->payment_status == 'partial'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : 'bg-red-100 text-red-800') }}">
                                                @if ($booking->payment_status == 'paid')
                                                    <i class="fas fa-check-circle mr-1"></i> Paid
                                                @elseif($booking->payment_status == 'partial')
                                                    <i class="fas fa-exclamation-circle mr-1"></i> Partial
                                                @else
                                                    <i class="fas fa-times mr-1"></i> Unpaid
                                                @endif
                                            </span>
                                            <div class="text-xs text-gray-600">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                                @if ($booking->paid_amount > 0)
                                                    <br>
                                                    <span class="text-green-600">Bayar: Rp
                                                        {{ number_format($booking->paid_amount, 0, ',', '.') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.pet-hotel.show', $booking->id) }}"
                                                class="text-blue-600 hover:text-blue-900 font-medium" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.pet-hotel.edit', $booking->id) }}"
                                                class="text-green-600 hover:text-green-900 font-medium" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="text-red-600 hover:text-red-900 font-medium" onclick="my_modal_1.showModal()" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <dialog id="my_modal_1" class="modal">
                                                <div class="modal-box">
                                                    <h3 class="text-lg font-bold">Delete Confirmation!</h3>
                                                    <p class="py-4">Yakin mau dihapus booking dari
                                                        {{ $booking->pet_name }} ({{ $booking->pet_type }})?</p>
                                                    <div class="modal-action">
                                                        <form
                                                            action="{{ route('admin.pet-hotel.destroy', $booking->id) }}"
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
                                        <div class="mt-2 text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($booking->created_at)->diffForHumans() }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4">
                        <i class="fas fa-hotel text-2xl text-blue-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada reservasi</h3>
                    <p class="text-gray-500 max-w-sm mx-auto mb-6">Tidak ada data reservasi pet hotel yang ditemukan.</p>
                    <a href="{{ route('admin.pet-hotel.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i> Buat Reservasi Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto submit filter ketika select berubah
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.querySelector('select[name="status"]');
            const paymentSelect = document.querySelector('select[name="payment_status"]');

            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }

            if (paymentSelect) {
                paymentSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }
        });
    </script>
@endpush
