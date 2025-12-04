@extends('Admin.layoutsAdmin.app')

@section('title', 'Detail Hewan - ' . $pet->name)

@section('subtitle', 'Detail lengkap informasi hewan adopsi')

@section('content')
    <div class="space-y-6">
        <!-- Header dengan Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <div class="flex items-center mb-2">
                    <a href="{{ route('admin.adoption-pets.index') }}"
                        class="text-blue-600 hover:text-blue-800 flex items-center mr-4">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <h1 class="text-2xl font-bold">Detail Hewan Adopsi</h1>
                </div>
                <p class="text-gray-600">ID: <span class="font-semibold">#{{ str_pad($pet->id, 6, '0', STR_PAD_LEFT) }}</span>
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.adoption-pets.edit', $pet->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <button onclick="updateStatusModal.showModal()" class="btn btn-outline">
                    <i class="fas fa-sync-alt mr-2"></i> Update Status
                </button>
                <button onclick="deleteModal.showModal()" class="btn btn-error">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Informasi Utama -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Galeri Foto -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Foto Hewan</h2>
                    @if ($pet->images && count($pet->images) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($pet->images as $index => $image)
                                <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Foto {{ $index + 1 }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                                        onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-image text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">Belum ada foto</p>
                        </div>
                    @endif
                </div>

                <!-- Informasi Dasar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Dasar</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Hewan</label>
                                <p class="text-lg font-bold">{{ $pet->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Hewan</label>
                                <div class="flex items-center">
                                    <i class="{{ $pet->species_icon }} text-gray-500 mr-2"></i>
                                    <span class="text-lg">{{ ucfirst($pet->species) }}</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ras/Breed</label>
                                <p class="text-lg">{{ $pet->breed ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
                                <p class="text-lg">{{ $pet->age }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <p class="text-lg">{{ $pet->gender_display }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Berat</label>
                                <p class="text-lg">{{ $pet->weight ? $pet->weight . ' kg' : '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
                                <p class="text-lg">{{ $pet->color ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $pet->description }}</p>
                    </div>

                    @if ($pet->special_notes)
                        <div class="mt-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Catatan Khusus</h3>
                            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                                <p class="text-gray-700 whitespace-pre-line">{{ $pet->special_notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Status Kesehatan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Status Kesehatan & Perawatan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                                <p class="text-lg">{{ $pet->entry_date }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Perawatan</label>
                                <div class="flex flex-wrap gap-2">
                                    @if ($pet->vaccinated)
                                        <span class="badge badge-success">
                                            <i class="fas fa-syringe mr-1"></i> Sudah Vaksin
                                        </span>
                                    @endif
                                    @if ($pet->sterilized)
                                        <span class="badge badge-info">
                                            <i class="fas fa-hospital mr-1"></i> Sudah Steril
                                        </span>
                                    @endif
                                    @if ($pet->dewormed)
                                        <span class="badge badge-warning">
                                            <i class="fas fa-bug mr-1"></i> Sudah Obat Cacing
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Sidebar -->
            <div class="space-y-6">
                <!-- Status Adopsi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Status Adopsi</h2>
                    <div class="space-y-4">
                        <div>
                            <span class="badge badge-lg {{ $pet->status_badge }} gap-2">
                                @if ($pet->status == 'available')
                                    <i class="fas fa-check-circle"></i> Tersedia
                                @elseif($pet->status == 'reserved')
                                    <i class="fas fa-clock"></i> Dipesan
                                @elseif($pet->status == 'adopted')
                                    <i class="fas fa-heart"></i> Diadopsi
                                @else
                                    <i class="fas fa-hourglass-half"></i> Menunggu
                                @endif
                            </span>
                        </div>

                        @if ($pet->adoption_fee > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Biaya Adopsi</label>
                                <p class="text-2xl font-bold text-green-600">
                                    Rp {{ number_format($pet->adoption_fee, 0, ',', '.') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Sistem -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Sistem</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID</span>
                            <span class="font-medium">#{{ str_pad($pet->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibuat</span>
                            <span class="font-medium">{{ $pet->created_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diupdate</span>
                            <span class="font-medium">{{ $pet->updated_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk update status -->
    <dialog id="updateStatusModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Update Status Adopsi</h3>
            <div class="py-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                <select id="newStatus" class="select select-bordered w-full">
                    <option value="available" {{ $pet->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="reserved" {{ $pet->status == 'reserved' ? 'selected' : '' }}>Dipesan</option>
                    <option value="adopted" {{ $pet->status == 'adopted' ? 'selected' : '' }}>Diadopsi</option>
                    <option value="pending" {{ $pet->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                </select>
            </div>
            <div class="modal-action">
                <button onclick="confirmUpdateStatus()" class="btn btn-primary">Update</button>
                <button onclick="updateStatusModal.close()" class="btn">Batal</button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Modal untuk konfirmasi hapus -->
    <dialog id="deleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Konfirmasi Penghapusan</h3>
            <p class="py-4">Apakah Anda yakin ingin menghapus hewan <strong>{{ $pet->name }}</strong>?</p>
            <div class="modal-action">
                <form method="POST" action="{{ route('admin.adoption-pets.destroy', $pet->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">Ya, Hapus</button>
                </form>
                <button onclick="deleteModal.close()" class="btn">Batal</button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Modal untuk melihat gambar -->
    <dialog id="imageModal" class="modal">
        <div class="modal-box max-w-4xl p-0">
            <div class="relative">
                <img id="modalImage" src="" alt="" class="w-full max-h-[80vh] object-contain">
                <button onclick="imageModal.close()"
                    class="absolute top-4 right-4 btn btn-sm btn-circle btn-ghost text-white bg-black/50">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
@endsection

@section('scripts')
    <script>
        function openImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            imageModal.showModal();
        }

        function confirmUpdateStatus() {
            const newStatus = document.getElementById('newStatus').value;

            fetch('{{ route('admin.adoption-pets.update-status', $pet->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: newStatus
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
                    alert('Terjadi kesalahan saat memperbarui status');
                });
        }
    </script>
@endsection
