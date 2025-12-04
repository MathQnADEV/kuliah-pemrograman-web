@extends('layouts.app')

@section('title', 'Pembayaran Pet Hotel - Pet Hotel & Adopt')

@section('styles')
<style>
    .payment-method input:checked + label {
        border-color: #3b82f6;
        border-width: 2px;
        background-color: #eff6ff;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('user.pet-hotel.show', $booking->id) }}" class="text-primary hover:text-primary-dark flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail Booking
        </a>
    </div>

    <div class="card bg-base-100 shadow-lg">
        <div class="card-body">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold">Pembayaran Pet Hotel</h1>
                <p class="text-gray-600">Lakukan pembayaran untuk reservasi hewan peliharaan Anda</p>
            </div>

            <!-- Informasi Booking -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold mb-2">Detail Booking</h3>
                        <p><span class="text-gray-600">ID Booking:</span> <strong>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</strong></p>
                        <p><span class="text-gray-600">Nama Hewan:</span> {{ $booking->pet_name }}</p>
                        <p><span class="text-gray-600">Tipe Kamar:</span> {{ ucfirst($booking->room_type) }}</p>
                        <p><span class="text-gray-600">Durasi:</span> {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }} hari</p>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2">Detail Pembayaran</h3>
                        <p><span class="text-gray-600">Total Tagihan:</span></p>
                        <p class="text-2xl font-bold text-primary">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-2">Batas Waktu Pembayaran: {{ \Carbon\Carbon::now()->addHours(24)->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4">Pilih Metode Pembayaran</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="payment-method {{ old('payment_method', 'qris') == 'qris' ? 'border-primary' : '' }}">
                        <input type="radio" id="qris" name="payment_method" value="qris"
                               {{ old('payment_method', 'qris') == 'qris' ? 'checked' : '' }} class="hidden">
                        <label for="qris" class="cursor-pointer block p-4 border rounded-lg hover:border-primary transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-qrcode text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold">QRIS</h4>
                                    <p class="text-sm text-gray-600">Scan QR Code</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div id="qris-section" class="p-6 bg-gray-50 rounded-lg mb-6">
                    <div class="text-center mb-4">
                        <h3 class="font-bold mb-2">Scan QR Code untuk Pembayaran</h3>
                        <p class="text-gray-600 text-sm">Gunakan aplikasi mobile banking atau e-wallet untuk scan QR code</p>
                    </div>

                    <div class="flex flex-col items-center">
                        <!-- QR Code Placeholder -->
                        <div class="bg-white p-4 rounded-lg shadow-inner mb-4">
                            <div class="w-64 h-64 bg-white border-4 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-gray-400 text-6xl mb-2">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <p class="text-sm text-gray-500">QR Code Pembayaran</p>
                                    <p class="text-xs text-gray-400 mt-1">ID: #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-gray-600 mb-2">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-primary">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Upload Bukti Pembayaran -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4">Konfirmasi Pembayaran</h2>
                <form action="{{ route('user.pet-hotel.payment.confirm', $booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="payment_method" id="selected_payment_method" value="qris">

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Upload Bukti Pembayaran (Opsional)</label>
                            <p class="text-sm text-gray-600 mb-3">Unggah screenshot/slip pembayaran untuk mempercepat proses verifikasi</p>
                            <div class="flex items-center justify-center w-full">
                                <label for="payment_proof" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                                    </div>
                                    <input id="payment_proof" name="payment_proof" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            <div id="preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">Preview:</p>
                                <div class="relative inline-block">
                                    <img id="preview-image" class="h-32 rounded-lg border shadow-sm">
                                    <button type="button" onclick="removeImage()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-blue-50 rounded-lg mb-6">
                            <div class="flex">
                                <i class="fas fa-info-circle text-blue-500 mr-2 mt-1"></i>
                                <div>
                                    <p class="text-sm text-blue-700 font-semibold mb-1">Informasi Penting</p>
                                    <ul class="text-sm text-blue-700 list-disc pl-5">
                                        <li>Setelah mengklik "Selesai Pembayaran", status booking akan berubah menjadi menunggu verifikasi</li>
                                        <li>Admin akan memverifikasi pembayaran Anda dalam 1x24 jam</li>
                                        <li>Jika tidak ada konfirmasi dalam waktu 24 jam, hubungi Customer Service</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-8">
                                <i class="fas fa-check-circle mr-2"></i> Selesai Pembayaran
                            </button>
                            <p class="text-sm text-gray-600 mt-3">
                                Dengan mengklik tombol ini, Anda menyatakan telah melakukan pembayaran
                            </p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Panduan Pembayaran -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="font-bold mb-4">Panduan Pembayaran QRIS</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="font-bold">1</span>
                        </div>
                        <h4 class="font-semibold mb-2">Buka Aplikasi</h4>
                        <p class="text-sm text-gray-600">Buka aplikasi mobile banking atau e-wallet Anda</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="font-bold">2</span>
                        </div>
                        <h4 class="font-semibold mb-2">Scan QR Code</h4>
                        <p class="text-sm text-gray-600">Pilih fitur scan QR dan arahkan kamera ke QR code di atas</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="font-bold">3</span>
                        </div>
                        <h4 class="font-semibold mb-2">Konfirmasi Pembayaran</h4>
                        <p class="text-sm text-gray-600">Konfirmasi nominal dan selesaikan pembayaran</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

    // Preview gambar upload
    document.getElementById('payment_proof').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Hapus gambar preview
    function removeImage() {
        document.getElementById('payment_proof').value = '';
        document.getElementById('preview-container').classList.add('hidden');
    }

    // Copy virtual account
    function copyVirtualAccount() {
        const virtualAccount = '{{ $virtualAccount }}';
        navigator.clipboard.writeText(virtualAccount).then(() => {
            // Show toast or alert
            alert('Nomor Virtual Account berhasil disalin!');
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Trigger change event for default selected payment method
        const defaultMethod = document.querySelector('input[name="payment_method"]:checked');
        if (defaultMethod) {
            defaultMethod.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection
