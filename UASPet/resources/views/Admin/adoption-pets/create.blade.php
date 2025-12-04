@extends('Admin.layoutsAdmin.app')

@section('title', 'Tambah Hewan Adopsi Baru')

@section('styles')
<style>
    .image-preview-item:hover img {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    #imagePreview {
        background-color: #f9fafb;
    }

    #noImageText {
        min-height: 100px;
    }
</style>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Hewan Adopsi</h1>
            <p class="text-gray-600">Lengkapi informasi hewan yang akan diadopsi</p>
        </div>
        <a href="{{ route('admin.adoption-pets.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.adoption-pets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-8">
                <!-- Informasi Dasar -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Hewan -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Nama Hewan <span class="text-red-500">*</span></span>
                                </div>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                       class="input input-bordered w-full @error('name') input-error @enderror"
                                       placeholder="Contoh: Milo, Bella, dll">
                                @error('name')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Jenis Hewan -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Jenis Hewan <span class="text-red-500">*</span></span>
                                </div>
                                <select name="species" required class="select select-bordered w-full @error('species') select-error @enderror">
                                    <option value="" disabled {{ old('species') ? '' : 'selected' }}>Pilih jenis</option>
                                    <option value="kucing" {{ old('species') == 'kucing' ? 'selected' : '' }}>Kucing</option>
                                    <option value="anjing" {{ old('species') == 'anjing' ? 'selected' : '' }}>Anjing</option>
                                    <option value="kelinci" {{ old('species') == 'kelinci' ? 'selected' : '' }}>Kelinci</option>
                                    <option value="burung" {{ old('species') == 'burung' ? 'selected' : '' }}>Burung</option>
                                    <option value="hamster" {{ old('species') == 'hamster' ? 'selected' : '' }}>Hamster</option>
                                    <option value="lainnya" {{ old('species') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('species')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Ras -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Ras</span>
                                </div>
                                <input type="text" name="breed" value="{{ old('breed') }}"
                                       class="input input-bordered w-full @error('breed') input-error @enderror"
                                       placeholder="Contoh: Persian, Golden Retriever, dll">
                                @error('breed')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Umur -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Umur (bulan) <span class="text-red-500">*</span></span>
                                </div>
                                <input type="decimal" name="age" required min="0" value="{{ old('age') }}"
                                       class="input input-bordered w-full @error('age') input-error @enderror"
                                       placeholder="Contoh: 12 (untuk 1 tahun)">
                                @error('age')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Jenis Kelamin <span class="text-red-500">*</span></span>
                                </div>
                                <select name="gender" required class="select select-bordered w-full @error('gender') select-error @enderror">
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih jenis kelamin</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Jantan</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Betina</option>
                                </select>
                                @error('gender')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Warna -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Warna</span>
                                </div>
                                <input type="text" name="color" value="{{ old('color') }}"
                                       class="input input-bordered w-full @error('color') input-error @enderror"
                                       placeholder="Contoh: Putih, Hitam-Coklat, dll">
                                @error('color')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Berat -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Berat (kg)</span>
                                </div>
                                <input type="number" name="weight" step="0.01" min="0" value="{{ old('weight') }}"
                                       class="input input-bordered w-full @error('weight') input-error @enderror"
                                       placeholder="Contoh: 3.5">
                                @error('weight')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
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
                                    <span class="label-text font-medium">Tanggal Masuk <span class="text-red-500">*</span></span>
                                </div>
                                <input type="date" name="entry_date" required value="{{ old('entry_date', date('Y-m-d')) }}"
                                       class="input input-bordered w-full @error('entry_date') input-error @enderror">
                                @error('entry_date')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>
                    </div>

                    <!-- Checkbox Perawatan -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="label cursor-pointer justify-start">
                            <input type="checkbox" name="vaccinated" value="1" {{ old('vaccinated') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary mr-3">
                            <span class="label-text font-medium">Sudah Divaksin</span>
                        </label>

                        <label class="label cursor-pointer justify-start">
                            <input type="checkbox" name="sterilized" value="1" {{ old('sterilized') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary mr-3">
                            <span class="label-text font-medium">Sudah Disteril</span>
                        </label>

                        <label class="label cursor-pointer justify-start">
                            <input type="checkbox" name="dewormed" value="1" {{ old('dewormed') ? 'checked' : '' }}
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
                                    <span class="label-text font-medium">Status Adopsi <span class="text-red-500">*</span></span>
                                </div>
                                <select name="status" required class="select select-bordered w-full @error('status') select-error @enderror">
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status</option>
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Dipesan</option>
                                    <option value="adopted" {{ old('status') == 'adopted' ? 'selected' : '' }}>Sudah Diadopsi</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                </select>
                                @error('status')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Biaya Adopsi -->
                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-medium">Biaya Adopsi (Rp)</span>
                                </div>
                                <input type="number" name="adoption_fee" min="0" value="{{ old('adoption_fee', 0) }}"
                                       class="input input-bordered w-full @error('adoption_fee') input-error @enderror"
                                       placeholder="0 untuk gratis">
                                @error('adoption_fee')
                                    <div class="label">
                                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi dan Foto -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Deskripsi & Foto</h3>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text font-medium">Deskripsi <span class="text-red-500">*</span></span>
                            </div>
                            <textarea name="description" required rows="4"
                                      class="textarea textarea-bordered w-full @error('description') textarea-error @enderror"
                                      placeholder="Ceritakan tentang hewan ini, kepribadian, kebiasaan, dll">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>
                    </div>

                    <!-- Catatan Khusus -->
                    <div class="mb-6">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text font-medium">Catatan Khusus</span>
                            </div>
                            <textarea name="special_notes" rows="3"
                                      class="textarea textarea-bordered w-full @error('special_notes') textarea-error @enderror"
                                      placeholder="Informasi tambahan, kebutuhan khusus, dll">{{ old('special_notes') }}</textarea>
                            @error('special_notes')
                                <div class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>
                    </div>

                    <!-- Upload Foto -->
                    <div>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text font-medium">Foto Hewan</span>
                                <span class="label-text-alt">Maksimal 5 foto (JPG, PNG, maks 2MB)</span>
                            </div>
                            <input type="file" name="images[]" multiple accept="image/*"
                                   class="file-input file-input-bordered w-full @error('images.*') file-input-error @enderror"
                                   id="imagesInput">
                            @error('images.*')
                                <div class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('images')
                                <div class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>

                        <!-- Image Preview -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Pratinjau Gambar</span>
                                <button type="button" onclick="clearImagePreview()" class="btn btn-xs btn-error">
                                    <i class="fas fa-times mr-1"></i> Hapus Semua
                                </button>
                            </div>
                            <div id="imagePreview" class="flex flex-wrap gap-4 border border-gray-300 rounded-lg p-4 min-h-[100px]">
                                <div id="noImageText" class="flex items-center justify-center w-full text-gray-400">
                                    <div class="text-center">
                                        <i class="fas fa-image text-3xl mb-2"></i>
                                        <p>Belum ada gambar yang dipilih</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.adoption-pets.index') }}"
                       class="btn btn-outline px-6">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-6">
                        <i class="fas fa-save mr-2"></i> Simpan Hewan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imagesInput = document.getElementById('imagesInput');
        const imagePreview = document.getElementById('imagePreview');
        const noImageText = document.getElementById('noImageText');

        // Preview gambar saat dipilih
        imagesInput.addEventListener('change', function() {
            // Hapus pratinjau sebelumnya
            const existingPreviews = document.querySelectorAll('.image-preview-item');
            existingPreviews.forEach(preview => preview.remove());

            // Sembunyikan teks "tidak ada gambar"
            if (noImageText) {
                noImageText.style.display = 'none';
            }

            // Validasi jumlah file
            if (this.files.length > 5) {
                alert('Maksimal 5 foto yang dapat diupload');
                this.value = ''; // Reset input
                if (noImageText) {
                    noImageText.style.display = 'flex';
                }
                return;
            }

            // Tampilkan pratinjau untuk setiap file
            Array.from(this.files).forEach((file, index) => {
                // Validasi ukuran file
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert(`File ${file.name} terlalu besar. Maksimal 2MB`);
                    return;
                }

                // Validasi tipe file
                if (!file.type.match('image.*')) {
                    alert(`File ${file.name} bukan gambar`);
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewContainer = document.createElement('div');
                    previewContainer.className = 'image-preview-item relative';
                    previewContainer.innerHTML = `
                        <div class="relative group">
                            <img src="${e.target.result}"
                                 class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <button type="button"
                                        onclick="removeImagePreview(${index})"
                                        class="btn btn-sm btn-circle btn-error">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-1 text-xs text-gray-500 text-center truncate w-32">
                            ${file.name}
                        </div>
                    `;

                    // Insert sebelum noImageText
                    if (noImageText && noImageText.style.display !== 'none') {
                        imagePreview.insertBefore(previewContainer, noImageText);
                    } else {
                        imagePreview.appendChild(previewContainer);
                    }
                };

                reader.readAsDataURL(file);
            });
        });

        // Hapus semua gambar dari preview
        window.clearImagePreview = function() {
            // Hapus semua preview gambar
            const existingPreviews = document.querySelectorAll('.image-preview-item');
            existingPreviews.forEach(preview => preview.remove());

            // Reset input file
            imagesInput.value = '';

            // Tampilkan kembali teks "tidak ada gambar"
            if (noImageText) {
                noImageText.style.display = 'flex';
            }
        };

        // Hapus gambar tertentu dari preview
        window.removeImagePreview = function(index) {
            // Dapatkan file dari input
            const dt = new DataTransfer();
            const { files } = imagesInput;

            // Tambahkan semua file kecuali yang dihapus
            for (let i = 0; i < files.length; i++) {
                if (index !== i) {
                    dt.items.add(files[i]);
                }
            }

            // Update input files
            imagesInput.files = dt.files;

            // Hapus preview yang sesuai
            const previewItems = document.querySelectorAll('.image-preview-item');
            if (previewItems[index]) {
                previewItems[index].remove();
            }

            // Jika tidak ada gambar lagi, tampilkan teks default
            if (dt.files.length === 0 && noImageText) {
                noImageText.style.display = 'flex';
            } else {
                // Reorder preview items
                const remainingPreviews = document.querySelectorAll('.image-preview-item');
                remainingPreviews.forEach((preview, newIndex) => {
                    // Update event listener untuk tombol hapus
                    const removeBtn = preview.querySelector('button[onclick]');
                    if (removeBtn) {
                        removeBtn.setAttribute('onclick', `removeImagePreview(${newIndex})`);
                    }
                });
            }
        };
    });

    // Validasi form sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const imagesInput = document.getElementById('imagesInput');
        const statusSelect = document.querySelector('select[name="status"]');

        // Validasi foto (minimal 1 foto)
        if (imagesInput.files.length === 0) {
            e.preventDefault();
            alert('Harap pilih minimal 1 foto untuk hewan');
            imagesInput.focus();
            return;
        }

        // Validasi status
        if (!statusSelect.value) {
            e.preventDefault();
            alert('Harap pilih status adopsi');
            statusSelect.focus();
            return;
        }

        // Tampilkan loading
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
            submitBtn.disabled = true;
        }
    });
</script>
@endsection
