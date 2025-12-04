@extends('Admin.layoutsAdmin.app')

@section('title', 'Edit Hewan Adopsi - ' . $pet->name)

@section('styles')
    <style>
        .new-image-preview-item:hover img {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        #newImagesPreview,
        .group:hover .absolute {
            transition: all 0.3s ease;
        }
    </style>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Hewan Adopsi</h1>
                <p class="text-gray-600">ID: #{{ str_pad($pet->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <a href="{{ route('admin.adoption-pets.show', $pet->id) }}" class="btn btn-outline">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail
            </a>
        </div>

        @if (session('error'))
            <div class="alert alert-error bg-red-50 border border-red-200 text-red-800 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Current Images -->
        @if (is_array($pet->images) && count($pet->images) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Foto Saat Ini</h3>
                <div class="flex flex-wrap gap-4">
                    @foreach ($pet->images as $index => $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image) }}" alt="Foto {{ $index + 1 }}"
                                class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <button type="button" onclick="removeImage('{{ $image }}')"
                                    class="btn btn-sm btn-circle btn-error">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="mt-1 text-xs text-gray-500 text-center truncate w-32">
                                Foto {{ $index + 1 }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Form Edit -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.adoption-pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input hidden untuk gambar yang akan dihapus -->
                <input type="hidden" name="images_to_remove" id="imagesToRemove">

                <div class="space-y-8">
                    <!-- Informasi Dasar -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informasi Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Hewan -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Nama Hewan <span
                                                class="text-red-500">*</span></span>
                                    </div>
                                    <input type="text" name="name" required value="{{ old('name', $pet->name) }}"
                                        class="input input-bordered w-full">
                                </label>
                            </div>

                            <!-- Jenis Hewan -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Jenis Hewan <span
                                                class="text-red-500">*</span></span>
                                    </div>
                                    <select name="species" required class="select select-bordered w-full">
                                        <option value="kucing"
                                            {{ old('species', $pet->species) == 'kucing' ? 'selected' : '' }}>Kucing
                                        </option>
                                        <option value="anjing"
                                            {{ old('species', $pet->species) == 'anjing' ? 'selected' : '' }}>Anjing
                                        </option>
                                        <option value="kelinci"
                                            {{ old('species', $pet->species) == 'kelinci' ? 'selected' : '' }}>Kelinci
                                        </option>
                                        <option value="burung"
                                            {{ old('species', $pet->species) == 'burung' ? 'selected' : '' }}>Burung
                                        </option>
                                        <option value="hamster"
                                            {{ old('species', $pet->species) == 'hamster' ? 'selected' : '' }}>Hamster
                                        </option>
                                        <option value="lainnya"
                                            {{ old('species', $pet->species) == 'lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <!-- Ras/Breed -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Ras/Breed</span>
                                    </div>
                                    <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}"
                                        class="input input-bordered w-full"
                                        placeholder="Contoh: Persian, Golden Retriever, dll">
                                </label>
                            </div>

                            <!-- Umur -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Umur (bulan) <span
                                                class="text-red-500">*</span></span>
                                    </div>
                                    <input type="decimal" name="age" required min="0"
                                        value="{{ old('age', $pet->age) }}" class="input input-bordered w-full"
                                        placeholder="Contoh: 12 (untuk 1 tahun)">
                                </label>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Jenis Kelamin <span
                                                class="text-red-500">*</span></span>
                                    </div>
                                    <select name="gender" required class="select select-bordered w-full">
                                        <option value="male"
                                            {{ old('gender', $pet->gender) == 'male' ? 'selected' : '' }}>Jantan</option>
                                        <option value="female"
                                            {{ old('gender', $pet->gender) == 'female' ? 'selected' : '' }}>Betina</option>
                                    </select>
                                </label>
                            </div>

                            <!-- Warna -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Warna</span>
                                    </div>
                                    <input type="text" name="color" value="{{ old('color', $pet->color) }}"
                                        class="input input-bordered w-full" placeholder="Contoh: Putih, Hitam-Coklat, dll">
                                </label>
                            </div>

                            <!-- Berat -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Berat (kg)</span>
                                    </div>
                                    <input type="number" name="weight" step="0.01" min="0"
                                        value="{{ old('weight', $pet->weight) }}" class="input input-bordered w-full"
                                        placeholder="Contoh: 3.5">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Kesehatan -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Kesehatan & Perawatan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Tanggal Masuk -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Tanggal Masuk <span
                                                class="text-red-500">*</span></span>
                                    </div>
                                    <input type="date" name="entry_date" required
                                        value="{{ old('entry_date', $pet->entry_date) }}"
                                        class="input input-bordered w-full">
                                </label>
                            </div>
                        </div>

                        <!-- Checkbox Perawatan -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="label cursor-pointer justify-start">
                                <input type="checkbox" name="vaccinated" value="1"
                                    {{ old('vaccinated', $pet->vaccinated) ? 'checked' : '' }}
                                    class="checkbox checkbox-primary mr-3">
                                <span class="label-text font-medium">Sudah Divaksin</span>
                            </label>

                            <label class="label cursor-pointer justify-start">
                                <input type="checkbox" name="sterilized" value="1"
                                    {{ old('sterilized', $pet->sterilized) ? 'checked' : '' }}
                                    class="checkbox checkbox-primary mr-3">
                                <span class="label-text font-medium">Sudah Disteril</span>
                            </label>

                            <label class="label cursor-pointer justify-start">
                                <input type="checkbox" name="dewormed" value="1"
                                    {{ old('dewormed', $pet->dewormed) ? 'checked' : '' }}
                                    class="checkbox checkbox-primary mr-3">
                                <span class="label-text font-medium">Sudah Obat Cacing</span>
                            </label>
                        </div>
                    </div>

                    <!-- Informasi Adopsi -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informasi Adopsi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Status Adopsi -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Status Adopsi <span
                                                class="text-red-500">*</span></span>
                                    </div>
                                    <select name="status" required class="select select-bordered w-full">
                                        <option value="available"
                                            {{ old('status', $pet->status) == 'available' ? 'selected' : '' }}>Tersedia
                                        </option>
                                        <option value="reserved"
                                            {{ old('status', $pet->status) == 'reserved' ? 'selected' : '' }}>Dipesan
                                        </option>
                                        <option value="adopted"
                                            {{ old('status', $pet->status) == 'adopted' ? 'selected' : '' }}>Sudah Diadopsi
                                        </option>
                                        <option value="pending"
                                            {{ old('status', $pet->status) == 'pending' ? 'selected' : '' }}>Menunggu
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <!-- Biaya Adopsi -->
                            <div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text font-medium">Biaya Adopsi (Rp)</span>
                                    </div>
                                    <input type="number" name="adoption_fee" min="0"
                                        value="{{ old('adoption_fee', $pet->adoption_fee) }}"
                                        class="input input-bordered w-full" placeholder="0 untuk gratis">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi dan Catatan -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Deskripsi & Catatan</h3>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text font-medium">Deskripsi <span
                                            class="text-red-500">*</span></span>
                                </div>
                                <textarea name="description" required rows="4" class="textarea textarea-bordered w-full"
                                    placeholder="Ceritakan tentang hewan ini, kepribadian, kebiasaan, dll">{{ old('description', $pet->description) }}</textarea>
                            </label>
                        </div>

                        <!-- Catatan Khusus -->
                        <div class="mb-6">
                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text font-medium">Catatan Khusus</span>
                                </div>
                                <textarea name="special_notes" rows="3" class="textarea textarea-bordered w-full"
                                    placeholder="Informasi tambahan, kebutuhan khusus, dll">{{ old('special_notes', $pet->special_notes) }}</textarea>
                            </label>
                        </div>
                    </div>

                    <!-- Foto Tambahan -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Foto Tambahan</h3>

                        <div>
                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text font-medium">Tambah Foto Baru</span>
                                    <span class="label-text-alt">Maksimal 5 foto (JPG, PNG, maks 2MB)</span>
                                </div>
                                <input type="file" name="images[]" multiple accept="image/*"
                                    class="file-input file-input-bordered w-full" id="newImagesInput">
                            </label>

                            <!-- Preview untuk gambar baru -->
                            <div class="mt-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Pratinjau Gambar Baru</span>
                                    <button type="button" onclick="clearNewImagesPreview()"
                                        class="btn btn-xs btn-error">
                                        <i class="fas fa-times mr-1"></i> Hapus Semua
                                    </button>
                                </div>
                                <div id="newImagesPreview"
                                    class="flex flex-wrap gap-4 border border-gray-300 rounded-lg p-4 min-h-[100px]">
                                    <div id="noNewImageText"
                                        class="flex items-center justify-center w-full text-gray-400">
                                        <div class="text-center">
                                            <i class="fas fa-image text-3xl mb-2"></i>
                                            <p>Belum ada gambar baru yang dipilih</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.adoption-pets.show', $pet->id) }}" class="btn btn-outline px-6">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-6">
                            <i class="fas fa-save mr-2"></i> Update Hewan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk konfirmasi hapus gambar -->
    <dialog id="removeImageModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Konfirmasi Hapus Foto</h3>
            <p class="py-4">Apakah Anda yakin ingin menghapus foto ini?</p>
            <div class="modal-action">
                <button onclick="confirmRemoveImage()" class="btn btn-error">Ya, Hapus</button>
                <button onclick="removeImageModal.close()" class="btn">Batal</button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
@endsection

@section('scripts')
    <script>
        let imageToRemove = null;
        let imagesToRemove = [];

        function removeImage(imagePath) {
            imageToRemove = imagePath;
            removeImageModal.showModal();
        }

        function confirmRemoveImage() {
            if (!imageToRemove) return;

            // Tambahkan ke array gambar yang akan dihapus
            if (!imagesToRemove.includes(imageToRemove)) {
                imagesToRemove.push(imageToRemove);
                // Update hidden input
                document.getElementById('imagesToRemove').value = JSON.stringify(imagesToRemove);
            }

            // Kirim request hapus ke server
            fetch(`{{ route('admin.adoption-pets.remove-image', $pet->id) }}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        image_path: imageToRemove
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus preview gambar dari UI
                        const imageElements = document.querySelectorAll(`img[src*="${imageToRemove}"]`);
                        imageElements.forEach(img => {
                            const container = img.closest('.relative');
                            if (container) {
                                container.remove();
                            }
                        });

                        // Tampilkan pesan sukses
                        showToast('Gambar berhasil dihapus', 'success');

                        // Tutup modal
                        removeImageModal.close();
                        imageToRemove = null;

                        // Jika tidak ada gambar lagi, reload halaman
                        if (data.remaining_images && data.remaining_images.length === 0) {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    } else {
                        showToast(data.message || 'Gagal menghapus gambar', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat menghapus gambar', 'error');
                });
        }

        // Preview untuk gambar baru
        document.getElementById('newImagesInput').addEventListener('change', function() {
            const previewContainer = document.getElementById('newImagesPreview');
            const noImageText = document.getElementById('noNewImageText');

            // Hapus pratinjau sebelumnya
            const existingPreviews = document.querySelectorAll('.new-image-preview-item');
            existingPreviews.forEach(preview => preview.remove());

            // Sembunyikan teks "tidak ada gambar"
            if (noImageText) {
                noImageText.style.display = 'none';
            }

            // Validasi jumlah file
            if (this.files.length > 5) {
                alert('Maksimal 5 foto yang dapat ditambahkan');
                this.value = '';
                if (noImageText) {
                    noImageText.style.display = 'flex';
                }
                return;
            }

            // Tampilkan pratinjau
            Array.from(this.files).forEach((file, index) => {
                if (file.size > 2 * 1024 * 1024) {
                    alert(`File ${file.name} terlalu besar. Maksimal 2MB`);
                    return;
                }

                if (!file.type.match('image.*')) {
                    alert(`File ${file.name} bukan gambar`);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'new-image-preview-item relative';
                    previewItem.innerHTML = `
                    <div class="relative group">
                        <img src="${e.target.result}"
                             class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <button type="button"
                                    onclick="removeNewImagePreview(${index})"
                                    class="btn btn-sm btn-circle btn-error">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-1 text-xs text-gray-500 text-center truncate w-32">
                        ${file.name}
                    </div>
                `;
                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
        });

        function clearNewImagesPreview() {
            const input = document.getElementById('newImagesInput');
            input.value = '';

            const previewItems = document.querySelectorAll('.new-image-preview-item');
            previewItems.forEach(item => item.remove());

            const noImageText = document.getElementById('noNewImageText');
            if (noImageText) {
                noImageText.style.display = 'flex';
            }
        }

        function removeNewImagePreview(index) {
            const input = document.getElementById('newImagesInput');
            const dt = new DataTransfer();
            const files = Array.from(input.files);

            files.forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file);
                }
            });

            input.files = dt.files;

            const previewItems = document.querySelectorAll('.new-image-preview-item');
            if (previewItems[index]) {
                previewItems[index].remove();
            }

            // Update index untuk tombol hapus
            const remainingPreviews = document.querySelectorAll('.new-image-preview-item');
            remainingPreviews.forEach((preview, newIndex) => {
                const removeBtn = preview.querySelector('button[onclick]');
                if (removeBtn) {
                    removeBtn.setAttribute('onclick', `removeNewImagePreview(${newIndex})`);
                }
            });

            // Jika tidak ada gambar, tampilkan teks default
            if (dt.files.length === 0) {
                const noImageText = document.getElementById('noNewImageText');
                if (noImageText) {
                    noImageText.style.display = 'flex';
                }
            }
        }

        function showToast(message, type = 'info') {
            // Buat elemen toast
            const toast = document.createElement('div');
            toast.className = `toast toast-top toast-end z-50`;
            toast.innerHTML = `
            <div class="alert ${type === 'success' ? 'alert-success' : 'alert-error'}">
                <span>${message}</span>
            </div>
        `;

            document.body.appendChild(toast);

            // Hapus toast setelah 3 detik
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
                submitBtn.disabled = true;
            }
        });
    </script>
@endsection
