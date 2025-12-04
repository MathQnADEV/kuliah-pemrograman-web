@extends('Admin.layoutsAdmin.app')

@section('title', 'Kelola Hewan Adopsi')

@section('subtitle', 'Daftar Hewan yang Tersedia untuk Diadopsi')

@section('content')
<div class="space-y-6">
    <!-- Header dengan Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <a href="{{ route('admin.adoption-pets.index') }}"
           class="stat-card {{ !request('status') ? 'border-blue-500 bg-blue-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-600">Total Hewan</div>
        </a>
        <a href="{{ route('admin.adoption-pets.index', ['status' => 'available']) }}"
           class="stat-card {{ request('status') == 'available' ? 'border-green-500 bg-green-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['available'] }}</div>
            <div class="text-sm text-gray-600">Tersedia</div>
        </a>
        <a href="{{ route('admin.adoption-pets.index', ['status' => 'reserved']) }}"
           class="stat-card {{ request('status') == 'reserved' ? 'border-yellow-500 bg-yellow-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['reserved'] }}</div>
            <div class="text-sm text-gray-600">Dipesan</div>
        </a>
        <a href="{{ route('admin.adoption-pets.index', ['status' => 'adopted']) }}"
           class="stat-card {{ request('status') == 'adopted' ? 'border-blue-500 bg-blue-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['adopted'] }}</div>
            <div class="text-sm text-gray-600">Diadopsi</div>
        </a>
        <a href="{{ route('admin.adoption-pets.index', ['status' => 'pending']) }}"
           class="stat-card {{ request('status') == 'pending' ? 'border-gray-500 bg-gray-50' : '' }} p-4 rounded-lg border hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['pending'] }}</div>
            <div class="text-sm text-gray-600">Menunggu</div>
        </a>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form method="GET" action="{{ route('admin.adoption-pets.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="select select-bordered w-full">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>Dipesan</option>
                        <option value="adopted" {{ request('status') == 'adopted' ? 'selected' : '' }}>Diadopsi</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Hewan</label>
                    <select name="species" class="select select-bordered w-full">
                        <option value="all" {{ request('species') == 'all' ? 'selected' : '' }}>Semua Jenis</option>
                        @foreach($speciesList as $species)
                            <option value="{{ $species }}" {{ request('species') == $species ? 'selected' : '' }}>
                                {{ ucfirst($species) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="gender" class="select select-bordered w-full">
                        <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Jantan</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="input input-bordered w-full" placeholder="Cari nama/ras...">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="flex space-x-2">
                    <button type="submit" class="btn btn-primary px-6">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <a href="{{ route('admin.adoption-pets.index') }}" class="btn btn-outline">
                        <i class="fas fa-times mr-2"></i> Reset
                    </a>
                </div>
                <a href="{{ route('admin.adoption-pets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Tambah Hewan
                </a>
            </div>
        </form>
    </div>

    <!-- Daftar Hewan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-linear-to-r from-blue-50 to-white">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Hewan Adopsi</h2>
            <p class="text-gray-600 text-sm mt-1">Menampilkan {{ $pets->total() }} hewan</p>
        </div>

        @if($pets->count() > 0)
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($pets as $pet)
                    <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <!-- Badge Status -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="badge {{ $pet->status_badge }} gap-2">
                                @if($pet->status == 'available')
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

                        <!-- Image -->
                        <figure class="px-6 pt-6">
                            <div class="h-48 w-full rounded-xl overflow-hidden bg-gray-100">

                                <img src="{{ asset('storage/' . $pet->images[0]) }}"
                                     alt="{{ $pet->name }}"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        </figure>

                        <!-- Card Body -->
                        <div class="card-body pt-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="card-title text-lg font-bold">{{ $pet->name }}</h3>
                                    <div class="flex items-center mt-1">
                                        <i class="{{ $pet->species_icon }} text-gray-500 mr-2"></i>
                                        <span class="text-gray-600">{{ ucfirst($pet->species) }}</span>
                                    </div>
                                </div>
                                <div class="badge badge-outline">
                                    {{ $pet->gender }}
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-birthday-cake text-gray-400 mr-2"></i>
                                    <span>{{ $pet->age }}</span>
                                </div>
                                @if($pet->breed)
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-dna text-gray-400 mr-2"></i>
                                    <span>{{ $pet->breed }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Health Badges -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if($pet->vaccinated)
                                <span class="badge badge-success badge-sm">
                                    <i class="fas fa-syringe mr-1"></i> Vaksin
                                </span>
                                @endif
                                @if($pet->sterilized)
                                <span class="badge badge-info badge-sm">
                                    <i class="fas fa-hospital mr-1"></i> Steril
                                </span>
                                @endif
                                @if($pet->dewormed)
                                <span class="badge badge-warning badge-sm">
                                    <i class="fas fa-bug mr-1"></i> Obat Cacing
                                </span>
                                @endif
                            </div>

                            <!-- Adoption Fee -->
                            @if($pet->adoption_fee > 0)
                            <div class="mb-4">
                                <div class="text-sm text-gray-500">Biaya Adopsi</div>
                                <div class="text-lg font-bold text-green-600">
                                    Rp {{ number_format($pet->adoption_fee, 0, ',', '.') }}
                                </div>
                            </div>
                            @endif

                            <!-- Card Actions -->
                            <div class="card-actions flex justify-between">
                                <a href="{{ route('admin.adoption-pets.show', $pet->id) }}"
                                   class="btn btn-sm btn-primary flex-1 mr-2">
                                    <i class="fas fa-eye mr-2"></i> Detail
                                </a>
                                <div class="dropdown dropdown-end">
                                    <button class="btn btn-sm btn-ghost">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-20">
                                        <li>
                                            <a href="{{ route('admin.adoption-pets.edit', $pet->id) }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button onclick="deleteModal{{ $pet->id }}.showModal()">
                                                <i class="fas fa-trash text-error"></i> Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Konfirmasi Hapus -->
                    <dialog id="deleteModal{{ $pet->id }}" class="modal">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg">Konfirmasi Penghapusan</h3>
                            <p class="py-4">Apakah Anda yakin ingin menghapus hewan <strong>{{ $pet->name }}</strong>?</p>
                            <div class="modal-action">
                                <form method="POST" action="{{ route('admin.adoption-pets.destroy', $pet->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error">Ya, Hapus</button>
                                </form>
                                <button onclick="deleteModal{{ $pet->id }}.close()" class="btn">Batal</button>
                            </div>
                        </div>
                        <form method="dialog" class="modal-backdrop">
                            <button>close</button>
                        </form>
                    </dialog>
                    @endforeach
                </div>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $pets->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4">
                    <i class="fas fa-paw text-2xl text-blue-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada hewan adopsi</h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-6">Tidak ada data hewan adopsi yang ditemukan.</p>
                <a href="{{ route('admin.adoption-pets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Tambah Hewan Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto submit filter
        const filters = ['status', 'species', 'gender'];
        filters.forEach(filter => {
            const element = document.querySelector(`select[name="${filter}"]`);
            if (element) {
                element.addEventListener('change', function() {
                    this.form.submit();
                });
            }
        });

        // Image preview for create/edit forms
        const imageInput = document.getElementById('images');
        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const previewContainer = document.getElementById('imagePreview');
                previewContainer.innerHTML = '';

                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-24 h-24 object-cover rounded-lg">
                            <button type="button" class="absolute -top-2 -right-2 btn btn-xs btn-circle btn-error" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        previewContainer.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            });
        }
    });
</script>
@endsection
