@extends('Admin.layoutsAdmin.app')

@section('title', 'Edit Booking #' . str_pad($booking->id, 6, '0', STR_PAD_LEFT))

@section('subtitle', 'Edit informasi reservasi pet hotel')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Booking Pet Hotel</h1>
            <p class="text-gray-600">ID Booking: #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('admin.pet-hotel.show', $booking->id) }}" class="btn btn-outline">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.pet-hotel.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Informasi Pemilik -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pemilik</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih User</label>
                            <select name="user_id" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
                            <input type="text" name="owner_name" required value="{{ old('owner_name', $booking->owner_name) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" name="owner_phone" required value="{{ old('owner_phone', $booking->owner_phone) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Informasi Hewan -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Hewan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Hewan</label>
                            <input type="text" name="pet_name" required value="{{ old('pet_name', $booking->pet_name) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Hewan</label>
                            <input type="text" name="pet_type" required value="{{ old('pet_type', $booking->pet_type) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Berat (kg)</label>
                            <input type="number" name="pet_weight" step="0.1" required value="{{ old('pet_weight', $booking->pet_weight) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Temperamen</label>
                            <select name="temprament" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="Friendly" {{ $booking->temprament == 'Friendly' ? 'selected' : '' }}>Friendly</option>
                                <option value="Calm" {{ $booking->temprament == 'Calm' ? 'selected' : '' }}>Calm</option>
                                <option value="Energetic" {{ $booking->temprament == 'Energetic' ? 'selected' : '' }}>Energetic</option>
                                <option value="Shy" {{ $booking->temprament == 'Shy' ? 'selected' : '' }}>Shy</option>
                                <option value="Aggressive" {{ $booking->temprament == 'Aggressive' ? 'selected' : '' }}>Aggressive</option>
                                <option value="Playful" {{ $booking->temprament == 'Playful' ? 'selected' : '' }}>Playful</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Informasi Booking -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Booking</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                            <select name="room_type" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="standard" {{ $booking->room_type == 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="premium" {{ $booking->room_type == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="luxury" {{ $booking->room_type == 'luxury' ? 'selected' : '' }}>Luxury</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Makanan</label>
                            <select name="bring_own_food" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="1" {{ $booking->bring_own_food ? 'selected' : '' }}>Bawa makanan sendiri</option>
                                <option value="0" {{ !$booking->bring_own_food ? 'selected' : '' }}>Makanan dari pet hotel</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                            <input type="date" name="check_in" required value="{{ old('check_in', $booking->check_in->format('Y-m-d')) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                            <input type="date" name="check_out" required value="{{ old('check_out', $booking->check_out->format('Y-m-d')) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Informasi Pembayaran dan Status -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pembayaran dan Status</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Harga (Rp)</label>
                            <input type="number" name="total_price" required value="{{ old('total_price', $booking->total_price) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                            <select name="payment_status" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="partial" {{ $booking->payment_status == 'partial' ? 'selected' : '' }}>Partial</option>
                                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Booking</label>
                            <select name="status" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked-in</option>
                                <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked-out</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan User (Opsional)</label>
                        <textarea name="user_notes" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Catatan dari user...">{{ old('user_notes', $booking->user_notes) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Admin (Opsional)</label>
                        <textarea name="admin_notes" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Tambahkan catatan admin...">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.pet-hotel.show', $booking->id) }}"
                       class="btn btn-outline px-6">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-6">
                        <i class="fas fa-save mr-2"></i> Update Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update tanggal minimum untuk check-out saat check-in berubah
        document.querySelector('input[name="check_in"]').addEventListener('change', function() {
            document.querySelector('input[name="check_out"]').min = this.value;
        });
    });
</script>
@endpush
