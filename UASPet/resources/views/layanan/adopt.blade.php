@extends('layouts.app')

@section('title', 'Adopsi')

@section('styles')
<style>
    /* Custom styles for image hover effect */
    .group:hover img {
        transform: scale(1.05);
    }

    /* Lightbox modal styling */
    #image-lightbox .modal-box {
        background: transparent;
        box-shadow: none;
    }

    #image-lightbox::backdrop {
        background: rgba(0, 0, 0, 0.7);
    }

    /* Animation for image lightbox */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    #lightbox-image {
        animation: fadeIn 0.3s ease-out;
    }

    /* Custom scrollbar for modal */
    #modal-content {
        max-height: 80vh;
        overflow-y: auto;
    }

    #modal-content::-webkit-scrollbar {
        width: 8px;
    }

    #modal-content::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    #modal-content::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    #modal-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Status kesehatan badge styling */
    .badge-success {
        background-color: #10b981 !important;
        color: white !important;
        border: none;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
@endsection

@section('content')
    <section class="hero min-h-[50vh] text-white hero-adoption">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center">
            <div class="max-w-4xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Temukan Sahabat Baru</h1>
                <p class="text-xl md:text-2xl mb-8">Berikan rumah dan kasih sayang kepada hewan-hewan yang membutuhkan
                    keluarga</p>
                <a href="#pets-list" class="btn btn-secondary btn-lg text-white px-8 py-3 rounded-full">
                    <i class="fas fa-heart mr-2"></i>
                    Lihat Hewan Tersedia
                </a>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1">
                    <img src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
                        alt="Happy adopted pets" class="rounded-2xl shadow-2xl w-full h-96 object-cover" />
                </div>
                <div class="flex-1">
                    <h2 class="text-4xl font-bold mb-6 text-primary">Mengapa Mengadopsi?</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Mengadopsi hewan tidak hanya memberikan rumah baru untuk mereka yang membutuhkan,
                        tetapi juga membawa kebahagiaan dan manfaat bagi kehidupan Anda.
                    </p>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-4 mt-1">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Menyelamatkan Nyawa</h4>
                                <p class="text-gray-600">Memberikan kesempatan kedua untuk hewan yang membutuhkan rumah</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-4 mt-1">
                                <i class="fas fa-home text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Hewan Terawat</h4>
                                <p class="text-gray-600">Semua hewan telah mendapatkan perawatan kesehatan dasar dan
                                    vaksinasi</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-4 mt-1">
                                <i class="fas fa-handshake text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Proses Mudah</h4>
                                <p class="text-gray-600">Proses adopsi yang transparan dan dibimbing oleh tim ahli kami</p>
                            </div>
                        </div>
                    </div>
                    <a href="#adoption-process" class="btn btn-primary btn-lg">Proses Adopsi</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter & Search Section -->
    <section class="py-8 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-2xl font-bold mb-6 text-center">Temukan Hewan Impian Anda</h3>

                <form method="GET" action="{{ route('adoption.public') }}" id="filter-form">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Search -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Cari Nama Hewan</span>
                            </label>
                            <div class="relative">
                                <label class="input">
                                    <i class="fas fa-search text-gray-400"></i>
                                    <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}" />
                                </label>
                            </div>
                        </div>

                        <!-- Species Filter -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Jenis Hewan</span>
                            </label>
                            <select class="select select-bordered w-full" name="species" id="species-filter">
                                <option value="">Semua Jenis</option>
                                <option value="anjing" {{ request('species') == 'anjing' ? 'selected' : '' }}>Anjing</option>
                                <option value="kucing" {{ request('species') == 'kucing' ? 'selected' : '' }}>Kucing</option>
                                <option value="kelinci" {{ request('species') == 'kelinci' ? 'selected' : '' }}>Kelinci
                                </option>
                                <option value="burung" {{ request('species') == 'burung' ? 'selected' : '' }}>Burung</option>
                            </select>
                        </div>

                        <!-- Age Filter -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Usia</span>
                            </label>
                            <select class="select select-bordered w-full" name="age_range" id="age-filter">
                                <option value="">Semua Usia</option>
                                <option value="0-1" {{ request('age_range') == '0-1' ? 'selected' : '' }}>Bayi (0-1
                                    tahun)</option>
                                <option value="1-3" {{ request('age_range') == '1-3' ? 'selected' : '' }}>Muda (1-3
                                    tahun)</option>
                                <option value="3-7" {{ request('age_range') == '3-7' ? 'selected' : '' }}>Dewasa (3-7
                                    tahun)</option>
                                <option value="7+" {{ request('age_range') == '7+' ? 'selected' : '' }}>Senior (7+
                                    tahun)</option>
                            </select>
                        </div>

                        <!-- Gender Filter -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Jenis Kelamin</span>
                            </label>
                            <select class="select select-bordered w-full" name="gender" id="gender-filter">
                                <option value="">Semua</option>
                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Jantan</option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Betina
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="btn btn-primary mr-3">
                            <i class="fas fa-filter mr-2"></i>
                            Terapkan Filter
                        </button>
                        <a href="{{ route('adoption.public') }}" class="btn btn-outline">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Filter
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

<!-- Pets List Section -->
<section id="pets-list" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-4">Hewan yang Siap Diadopsi</h2>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
            Mereka semua menunggu untuk menemukan keluarga yang penuh kasih
        </p>

        @if ($pets->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-paw text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Tidak ada hewan yang ditemukan</h3>
                <p class="text-gray-600">Coba ubah filter pencarian Anda</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="pets-container">
                @foreach ($pets as $pet)
                    @php
                        $images = json_decode($pet->images, true) ?? [];
                        $mainImage = !empty($images)
                            ? asset('storage/' . $images[0])
                            : 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80';

                        $allImages = '';
                        if (!empty($images)) {
                            foreach ($images as $index => $image) {
                                $allImages .= asset('storage/' . $image) . ($index < count($images) - 1 ? ',' : '');
                            }
                        }

                        // Determine age category for display
                        $ageCategory = '';
                        if ($pet->age <= 1) {
                            $ageCategory = 'Bayi';
                        } elseif ($pet->age <= 3) {
                            $ageCategory = 'Muda';
                        } elseif ($pet->age <= 7) {
                            $ageCategory = 'Dewasa';
                        } else {
                            $ageCategory = 'Senior';
                        }

                        // Determine species display name
                        $speciesNames = [
                            'dog' => 'Anjing',
                            'cat' => 'Kucing',
                            'rabbit' => 'Kelinci',
                            'bird' => 'Burung',
                        ];
                        $speciesName = $speciesNames[$pet->species] ?? $pet->species;

                        // Determine badge color based on species
                        $badgeColor = '';
                        switch ($pet->species) {
                            case 'dog':
                                $badgeColor = 'badge-primary';
                                break;
                            case 'cat':
                                $badgeColor = 'badge-secondary';
                                break;
                            default:
                                $badgeColor = 'badge-accent';
                                break;
                        }
                    @endphp

                    <div class="card bg-base-100 shadow-xl pet-card"
                         data-pet-id="{{ $pet->id }}"
                         data-pet-name="{{ $pet->name }}"
                         data-pet-species="{{ $speciesName }}"
                         data-pet-breed="{{ $pet->breed ?? '-' }}"
                         data-pet-age="{{ number_format($pet->age, 1) }} tahun ($ageCategory)"
                         data-pet-gender="{{ $pet->gender == 'male' ? 'Jantan' : 'Betina' }}"
                         data-pet-color="{{ $pet->color ?? '-' }}"
                         data-pet-weight="{{ $pet->weight ? $pet->weight . ' kg' : '-' }}"
                         data-pet-description="{{ $pet->description }}"
                         data-pet-status="{{ $pet->status }}"
                         data-pet-vaccinated="{{ $pet->vaccinated ? 'Sudah' : 'Belum' }}"
                         data-pet-sterilized="{{ $pet->sterilized ? 'Sudah' : 'Belum' }}"
                         data-pet-dewormed="{{ $pet->dewormed ? 'Sudah' : 'Belum' }}"
                         data-pet-fee="{{ $pet->adoption_fee > 0 ? 'Rp ' . number_format($pet->adoption_fee, 0, ',', '.') : 'Gratis' }}"
                         data-pet-images="{{ $allImages }}"
                         data-pet-special-notes="{{ $pet->special_notes ?? '-' }}">
                        <figure class="px-4 pt-4">
                            <img src="{{ $mainImage }}" alt="{{ $pet->name }}"
                                class="rounded-xl h-64 w-full object-cover" />
                            @if ($pet->status != 'available')
                                <div class="absolute top-6 right-6 badge badge-error">
                                    {{ $pet->status == 'adopted' ? 'Telah Diadopsi' : 'Sudah Dipesan' }}
                                </div>
                            @endif
                        </figure>
                        <div class="card-body">
                            <h3 class="card-title">{{ $pet->name }}</h3>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <div class="badge {{ $badgeColor }}">
                                    {{ $speciesName }}
                                </div>
                                @if ($pet->breed)
                                    <div class="badge badge-outline">{{ $pet->breed }}</div>
                                @endif
                                <div class="badge badge-outline">
                                    {{ $pet->gender == 'male' ? 'Jantan' : 'Betina' }}
                                </div>
                                @if ($pet->color)
                                    <div class="badge badge-outline">{{ $pet->color }}</div>
                                @endif
                            </div>
                            <p class="text-gray-600">
                                {{ Str::limit($pet->description, 100) }}
                            </p>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-birthday-cake mr-1"></i>
                                        {{ number_format($pet->age, 1) }} tahun ({{ $ageCategory }})
                                    </div>
                                    @if ($pet->adoption_fee > 0)
                                        <div class="font-bold text-primary">
                                            Rp {{ number_format($pet->adoption_fee, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center gap-4 text-sm">
                                    @if ($pet->vaccinated)
                                        <span class="text-green-600">
                                            <i class="fas fa-syringe mr-1"></i> Vaksin
                                        </span>
                                    @endif
                                    @if ($pet->sterilized)
                                        <span class="text-green-600">
                                            <i class="fas fa-user-md mr-1"></i> Steril
                                        </span>
                                    @endif
                                    @if ($pet->dewormed)
                                        <span class="text-green-600">
                                            <i class="fas fa-pills mr-1"></i> Cacing
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-actions justify-end mt-4">
                                @if ($pet->status == 'available')
                                    <button class="btn btn-primary btn-sm pet-detail-btn"
                                            data-pet-id="{{ $pet->id }}">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Detail
                                    </button>
                                @else
                                    <button class="btn btn-outline btn-sm" disabled>
                                        Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($pets->hasPages())
                <div class="text-center mt-12">
                    {{ $pets->links() }}
                </div>
            @endif
        @endif
    </div>
</section>

<!-- Pet Detail Modal -->
<dialog id="pet-modal" class="modal">
    <div class="modal-box max-w-5xl p-0">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 z-10">✕</button>
        </form>

        <div id="modal-content" class="p-6">
            <!-- Content will be dynamically inserted here -->
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Lightbox Modal for Enlarged Image -->
<dialog id="image-lightbox" class="modal">
    <div class="modal-box max-w-5xl p-0 bg-transparent shadow-none">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 z-10 bg-base-100">✕</button>
        </form>
        <div class="flex justify-center items-center h-full">
            <img id="lightbox-image" src="" alt="Enlarged image" class="max-w-full max-h-[80vh] object-contain rounded-lg">
        </div>
    </div>
    <form method="dialog" class="modal-backdrop bg-black/70">
        <button>close</button>
    </form>
</dialog>

    <!-- Adoption Process Section -->
    <section id="adoption-process" class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Proses Adopsi</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Ikuti langkah-langkah mudah ini untuk membawa
                pulang sahabat baru Anda</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pilih Hewan</h3>
                    <p class="text-gray-600">Jelajahi hewan-hewan yang tersedia dan pilih yang sesuai dengan Anda</p>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-3">Chat admin melalui WhatsApp</h3>
                    <p class="text-gray-600">Setelah memilih hewan, chat admin melalui WhatsApp untuk informasi lebih detail</p>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kunjungan</h3>
                    <p class="text-gray-600">Anda menunjungi petshop dan bertemu dengan petugas</p>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">
                        4
                    </div>
                    <h3 class="text-xl font-bold mb-3">Bawa Pulang</h3>
                    <p class="text-gray-600">Setelah disetujui, Anda bisa membawa pulang hewan kesayangan Anda</p>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#faq" class="btn btn-primary btn-lg">
                    <i class="fas fa-question-circle mr-2"></i>
                    Lihat FAQ Adopsi
                </a>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Kisah Sukses Adopsi</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Lihat bagaimana hewan-hewan menemukan rumah dan
                kebahagiaan mereka</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Story 1 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-6 pt-6">
                        <div class="flex space-x-2">
                            <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=662&q=80"
                                alt="Max" class="w-1/2 h-40 object-cover rounded-lg" />
                            <img src="https://images.unsplash.com/photo-1536766820879-059fec98ec0a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80"
                                alt="Max with family" class="w-1/2 h-40 object-cover rounded-lg" />
                        </div>
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title">Max & Keluarga Santoso</h3>
                        <p class="text-gray-600">"Max yang dulunya takut manusia, sekarang menjadi anggota keluarga yang
                            paling ceria. Dia suka bermain dengan anak-anak kami."</p>
                        <div class="card-actions justify-end mt-4">
                            <div class="badge badge-primary">Diadopsi 6 bulan lalu</div>
                        </div>
                    </div>
                </div>

                <!-- Story 2 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-6 pt-6">
                        <div class="flex space-x-2">
                            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
                                alt="Luna" class="w-1/2 h-40 object-cover rounded-lg" />
                            <img src="https://images.unsplash.com/photo-1533738363-b7f9aef128ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
                                alt="Luna at home" class="w-1/2 h-40 object-cover rounded-lg" />
                        </div>
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title">Luna & Rina</h3>
                        <p class="text-gray-600">"Luna menemani saya bekerja dari rumah setiap hari. Dia sangat penyayang
                            dan telah menjadi teman terbaik saya."</p>
                        <div class="card-actions justify-end mt-4">
                            <div class="badge badge-primary">Diadopsi 3 bulan lalu</div>
                        </div>
                    </div>
                </div>

                <!-- Story 3 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-6 pt-6">
                        <div class="flex space-x-2">
                            <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80"
                                alt="Bella" class="w-1/2 h-40 object-cover rounded-lg" />
                            <img src="https://images.unsplash.com/photo-1568640347023-a616a30bc3bd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80"
                                alt="Bella in park" class="w-1/2 h-40 object-cover rounded-lg" />
                        </div>
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title">Bella & Keluarga Wijaya</h3>
                        <p class="text-gray-600">"Bella membawa begitu banyak kegembiraan dalam hidup kami. Setiap akhir
                            pekan kami membawanya ke taman untuk bermain."</p>
                        <div class="card-actions justify-end mt-4">
                            <div class="badge badge-primary">Diadopsi 1 tahun lalu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Pertanyaan Umum tentang Adopsi</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Temukan jawaban untuk pertanyaan yang sering
                diajukan tentang proses adopsi</p>

            <div class="max-w-3xl mx-auto">
                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" checked="checked" />
                    <div class="collapse-title text-xl font-medium">
                        Berapa biaya untuk mengadopsi hewan?
                    </div>
                    <div class="collapse-content">
                        <p>Biaya adopsi bervariasi tergantung jenis hewan dan perawatan yang telah diberikan. Biaya ini
                            mencakup vaksinasi, sterilisasi, pemeriksaan kesehatan, dan perawatan dasar lainnya. Rata-rata
                            biaya adopsi berkisar antara Rp 300.000 - Rp 1.000.000.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah ada persyaratan khusus untuk mengadopsi?
                    </div>
                    <div class="collapse-content">
                        <p>Ya, calon pemilik harus memenuhi beberapa persyaratan seperti: memiliki lingkungan rumah yang
                            aman, komitmen untuk merawat hewan seumur hidup, persetujuan dari semua anggota keluarga, dan
                            kemampuan finansial untuk memenuhi kebutuhan hewan.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Berapa lama proses adopsi biasanya?
                    </div>
                    <div class="collapse-content">
                        <p>Proses adopsi biasanya memakan waktu 1-2 minggu, tergantung pada kelengkapan dokumen dan jadwal
                            kunjungan rumah. Kami ingin memastikan bahwa setiap hewan ditempatkan di rumah yang tepat.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apa yang terjadi jika saya tidak bisa lagi merawat hewan yang diadopsi?
                    </div>
                    <div class="collapse-content">
                        <p>Kami memiliki kebijakan "return" di mana Anda dapat mengembalikan hewan kepada kami jika keadaan
                            tidak memungkinkan Anda untuk terus merawatnya. Kami akan menerima kembali hewan tersebut dan
                            mencari rumah baru yang sesuai.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah hewan yang diadopsi sudah divaksin dan disteril?
                    </div>
                    <div class="collapse-content">
                        <p>Ya, semua hewan yang tersedia untuk diadopsi telah mendapatkan vaksinasi dasar dan sebagian besar
                            telah disteril (kecuali untuk kasus medis tertentu). Kami juga memberikan sertifikat kesehatan
                            untuk setiap hewan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pet Detail Modal -->
    <dialog id="pet-modal" class="modal">
        <div class="modal-box max-w-4xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <div id="modal-content">
                <!-- Content will be dynamically inserted here -->
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
@endsection

@section('scripts')
<script>
    // WhatsApp number - ganti dengan nomor yang sesuai
    const whatsappNumber = "6281234567890"; // Format: 62 untuk Indonesia tanpa tanda +

    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to all detail buttons
        document.querySelectorAll('.pet-detail-btn').forEach(button => {
            button.addEventListener('click', function() {
                const petId = this.getAttribute('data-pet-id');
                const petCard = this.closest('.card');

                // Get pet data from data attributes
                const petData = {
                    name: petCard.getAttribute('data-pet-name'),
                    species: petCard.getAttribute('data-pet-species'),
                    breed: petCard.getAttribute('data-pet-breed'),
                    age: petCard.getAttribute('data-pet-age'),
                    gender: petCard.getAttribute('data-pet-gender'),
                    color: petCard.getAttribute('data-pet-color'),
                    weight: petCard.getAttribute('data-pet-weight'),
                    description: petCard.getAttribute('data-pet-description'),
                    status: petCard.getAttribute('data-pet-status'),
                    vaccinated: petCard.getAttribute('data-pet-vaccinated'),
                    sterilized: petCard.getAttribute('data-pet-sterilized'),
                    dewormed: petCard.getAttribute('data-pet-dewormed'),
                    fee: petCard.getAttribute('data-pet-fee'),
                    specialNotes: petCard.getAttribute('data-pet-special-notes'),
                    images: petCard.getAttribute('data-pet-images') ?
                            petCard.getAttribute('data-pet-images').split(',') : []
                };

                // Create WhatsApp message
                const whatsappMessage = `Halo, saya tertarik untuk mengadopsi ${petData.name} (${petData.species}) dari website Anda. Boleh minta informasi lebih lanjut?`;
                const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappMessage)}`;

                // Build modal content with image gallery
                let imagesHtml = '';
                if (petData.images.length > 0) {
                    imagesHtml = `
                        <div class="mb-6">
                            <h3 class="text-lg font-bold mb-4">Galeri Foto</h3>
                            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                ${petData.images.map((img, index) => `
                                    <div class="cursor-pointer group relative" onclick="openLightbox('${img}')">
                                        <img src="${img}" alt="${petData.name} - Foto ${index + 1}"
                                             class="rounded-lg w-full h-24 object-cover transition-transform duration-300 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300 rounded-lg"></div>
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <i class="fas fa-search-plus text-white text-xl bg-black/50 p-2 rounded-full"></i>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                }

                // Perbaikan: Format status kesehatan dengan benar
                const healthStatus = [];
                if (petData.vaccinated === 'Sudah') healthStatus.push('Vaksin');
                if (petData.sterilized === 'Sudah') healthStatus.push('Steril');
                if (petData.dewormed === 'Sudah') healthStatus.push('Obat Cacing');

                const healthStatusHtml = healthStatus.length > 0
                    ? healthStatus.map(status => `<span class="badge badge-success mr-1 mb-1">${status}</span>`).join('')
                    : '<span class="text-gray-500">Tidak ada informasi</span>';

                const modalContent = document.getElementById('modal-content');
                modalContent.innerHTML = `
                    <h2 class="text-3xl font-bold mb-4 text-primary">${petData.name}</h2>

                    ${imagesHtml}

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-bold mb-4">Informasi Hewan</h3>
                            <div class="bg-base-100 rounded-lg border p-4">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Jenis</span>
                                        <span>${petData.species}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Ras</span>
                                        <span>${petData.breed}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Usia</span>
                                        <span>${petData.age.replace(/\$ageCategory/g, '').replace(/\(\)/g, '').trim()}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Jenis Kelamin</span>
                                        <span>${petData.gender}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Warna</span>
                                        <span>${petData.color}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Berat</span>
                                        <span>${petData.weight}</span>
                                    </div>
                                    <div class="flex justify-between items-start">
                                        <span class="font-semibold">Status Kesehatan</span>
                                        <div class="text-right">
                                            ${healthStatusHtml}
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Biaya Adopsi</span>
                                        <span class="font-bold text-primary">${petData.fee}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold mb-4">Deskripsi</h3>
                            <div class="bg-base-100 rounded-lg border p-4 mb-6">
                                <p class="text-gray-600">${petData.description}</p>
                            </div>

                            ${petData.specialNotes !== '-' ? `
                                <h3 class="text-xl font-bold mb-4">Catatan Khusus</h3>
                                <div class="bg-base-100 rounded-lg border p-4 mb-6">
                                    <p class="text-gray-600">${petData.specialNotes}</p>
                                </div>
                            ` : ''}

                            ${petData.status === 'available' ? `
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                                    <h4 class="font-bold text-green-800 mb-2">Hewan ini tersedia untuk diadopsi!</h4>
                                    <p class="text-green-700">Jika Anda tertarik dengan ${petData.name}, silakan hubungi kami via WhatsApp untuk informasi lebih lanjut tentang proses adopsi.</p>
                                </div>

                                <div class="space-y-3">
                                    <a href="${whatsappUrl}" target="_blank" class="btn btn-success btn-lg w-full">
                                        Hubungi via WhatsApp
                                    </a>
                                </div>
                            ` : `
                                <div class="bg-gray-100 border border-gray-300 rounded-lg p-4">
                                    <h4 class="font-bold text-gray-800 mb-2">Hewan ini telah menemukan rumah</h4>
                                    <p class="text-gray-700">${petData.name} telah diadopsi oleh keluarga yang penuh kasih. Lihat hewan lain yang masih membutuhkan rumah.</p>
                                </div>
                            `}
                        </div>
                    </div>
                `;

                // Show modal
                document.getElementById('pet-modal').showModal();
            });
        });
    });

    // Function to open lightbox with enlarged image
    window.openLightbox = function(imageUrl) {
        const lightboxImage = document.getElementById('lightbox-image');
        lightboxImage.src = imageUrl;
        lightboxImage.alt = 'Foto hewan';
        document.getElementById('image-lightbox').showModal();
    }

    // Function to copy WhatsApp message to clipboard
    window.copyWhatsAppMessage = function(petName, petSpecies) {
        const message = `Halo, saya tertarik untuk mengadopsi ${petName} (${petSpecies}) dari website Anda. Boleh minta informasi lebih lanjut?`;

        // Copy to clipboard
        navigator.clipboard.writeText(message).then(() => {
            // Show success notification
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success fixed top-4 right-4 z-50 w-80 shadow-lg';
            alertDiv.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Pesan WhatsApp berhasil disalin!</span>
                </div>
            `;
            document.body.appendChild(alertDiv);

            // Remove notification after 3 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
            alert('Gagal menyalin pesan. Silakan coba lagi.');
        });
    }
</script>
@endsection
