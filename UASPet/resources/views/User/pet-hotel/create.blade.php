{{-- resources/views/user/pet-hotel/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Buat Reservasi Pet Hotel')

@section('styles')
    {{-- <style>
        .forward-chain-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .rule-execution {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #4ade80;
            transition: all 0.3s ease;
        }

        .rule-execution.firing {
            background: rgba(74, 222, 128, 0.3);
            transform: translateX(10px);
        }

        .new-fact {
            background: rgba(255, 255, 255, 0.15);
            border: 2px dashed #0ea5e9;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fact-tag {
            display: inline-block;
            background: #8b5fbf;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            margin: 2px;
            font-size: 12px;
            animation: popIn 0.3s ease;
        }

        @keyframes popIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .conclusion-highlight {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(251, 191, 36, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(251, 191, 36, 0);
            }
        }

        .loading-indicator {
            text-align: center;
            padding: 20px;
        }

        .loading-indicator .dots {
            display: inline-block;
        }

        .loading-indicator .dots span {
            animation: blink 1.4s infinite both;
            display: inline-block;
            font-size: 24px;
        }

        .loading-indicator .dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading-indicator .dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {

            0%,
            80%,
            100% {
                opacity: 0;
            }

            40% {
                opacity: 1;
            }
        }

        .step-badge {
            display: inline-block;
            background: #4ade80;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            margin-right: 8px;
        }

        /* Tambahkan styling untuk 4 iterasi */
        .iteration {
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            border-left: 5px solid #8b5fbf;
        }

        .iteration:nth-child(1) {
            border-left-color: #4ade80;
        }

        .iteration:nth-child(2) {
            border-left-color: #3b82f6;
        }

        .iteration:nth-child(3) {
            border-left-color: #8b5fbf;
        }

        .iteration:nth-child(4) {
            border-left-color: #f59e0b;
        }

        .iteration h5 {
            color: white;
            font-size: 18px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }
    </style> --}}
    <style>
        .room-option.selected {
            border: 3px solid #8b5fbf !important;
            background: rgba(139, 95, 191, 0.1) !important;
            transform: scale(1.02);
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold">Buat Reservasi Pet Hotel</h1>
            <p class="text-gray-600">Isi data hewan Anda, sistem pakar akan merekomendasikan ruangan terbaik</p>
        </div>

        {{-- fallback error validate --}}
        @if($errors->any())
            <div class="alert alert-danger mb-6">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Sistem Pakar Forward Chaining -->
        <div class="forward-chain-box mb-8 hidden">
            <h3 class="text-xl font-semibold mb-4">
                <i class="fas fa-robot mr-2"></i> Sistem Pakar Forward Chaining
            </h3>

            <!-- Working Memory -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Fakta Awal:</h4>
                <div id="initialFacts" class="fact-list">
                    <!-- Fakta akan muncul di sini -->
                    <div class="text-center py-4 text-gray-300">
                        <i class="fas fa-database text-xl mb-2"></i>
                        <p>Masukkan data hewan untuk memulai analisis</p>
                    </div>
                </div>
            </div>

            <!-- Forward Chaining Process -->
            <div id="forwardChainProcess" class="hidden">
                <h4 class="font-semibold mb-4 text-gray-700">Proses Forward Chaining:</h4>

                <!-- Iterasi 1 -->
                <div class="iteration mb-4">
                    <h5 class="font-bold mb-2">Iterasi 1: Konversi Input ke Fakta</h5>
                    <div id="iteration1Rules"></div>
                    <div id="iteration1Facts" class="new-fact hidden mt-3">
                        <strong class="text-white">Fakta Baru:</strong>
                        <div class="fact-tags mt-2"></div>
                    </div>
                </div>

                <!-- Iterasi 2 -->
                <div class="iteration mb-4">
                    <h5 class="font-bold mb-2">Iterasi 2: Kategori Berat dan Sifat</h5>
                    <div id="iteration2Rules"></div>
                    <div id="iteration2Facts" class="new-fact hidden mt-3">
                        <strong class="text-white">Fakta Baru:</strong>
                        <div class="fact-tags mt-2"></div>
                    </div>
                </div>

                <!-- Iterasi 3 -->
                <div class="iteration mb-4">
                    <h5 class="font-bold mb-2">Iterasi 3: Kebutuhan Ruangan</h5>
                    <div id="iteration3Rules"></div>
                    <div id="iteration3Facts" class="new-fact hidden mt-3">
                        <strong class="text-white">Fakta Baru:</strong>
                        <div class="fact-tags mt-2"></div>
                    </div>
                </div>

                <!-- Iterasi 4 -->
                <div class="iteration mb-4">
                    <h5 class="font-bold mb-2">Iterasi 4: Rekomendasi Akhir</h5>
                    <div id="iteration4Rules"></div>
                    <div id="iteration4Facts" class="new-fact hidden mt-3">
                        <strong class="text-white">Fakta Baru:</strong>
                        <div class="fact-tags mt-2"></div>
                    </div>
                </div>
            </div>

            <!-- Loading -->
            <div id="loadingProcess" class="loading-indicator hidden">
                <div class="dots mb-3">
                    <span>.</span><span>.</span><span>.</span>
                </div>
                <p>Sistem pakar sedang menganalisis data...</p>
            </div>

            <!-- Conclusion -->
            <div id="conclusionSection" class="conclusion-highlight hidden">
                <i class="fas fa-check-circle text-4xl mb-3"></i>
                <h4 class="text-xl font-bold mb-2">HASIL ANALISIS SISTEM PAKAR</h4>
                <div id="finalConclusion" class="text-lg mb-2">
                    <!-- Kesimpulan akhir -->
                </div>
                <div id="conclusionReason" class="text-sm opacity-90">
                    <!-- Alasan -->
                </div>
            </div>
        </div>

        <!-- Form Input -->
        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <form id="petHotelForm" action="{{ route('user.pet-hotel.store') }}" method="POST">
                    @csrf

                    <!-- Data Pemilik -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 border-b pb-2">
                            <i class="fas fa-user mr-2 text-primary"></i>
                            1. Data Pemilik
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label mb-2">
                                    <span class="label-text font-semibold">Nama Pemilik *</span>
                                </label>
                                <input type="text" name="owner_name" id="ownerName" class="input input-bordered w-full"
                                    required value="{{ auth()->user()->name }}">
                            </div>

                            <div class="form-control">
                                <label class="label mb-2">
                                    <span class="label-text font-semibold">Nomor Telepon *</span>
                                </label>
                                <input type="tel" name="owner_phone" id="ownerPhone" class="input input-bordered w-full"
                                    required value="{{ auth()->user()->phone }}">
                            </div>
                        </div>
                    </div>

                    <!-- Data Hewan -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 border-b pb-2">
                            <i class="fas fa-paw mr-2 text-secondary"></i>
                            2-5. Data Hewan Peliharaan
                        </h3>

                        <div class="space-y-6">
                            <!-- Nama Peliharaan -->
                            <div class="form-control">
                                <label class="label mb-2">
                                    <span class="label-text font-semibold">2. Nama Peliharaan *</span>
                                </label>
                                <input type="text" name="pet_name" id="petName" class="input input-bordered w-full"
                                    required oninput="updateFacts()">
                            </div>

                            <!-- Jenis Peliharaan -->
                            <div class="form-control">
                                <label class="label mb-2">
                                    <span class="label-text font-semibold">3. Jenis Peliharaan *</span>
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-2">
                                    @foreach (['Kucing' => 'fa-cat', 'Anjing' => 'fa-dog', 'Kelinci' => 'fa-paw'] as $type => $icon)
                                        <label
                                            class="flex items-center space-x-3 p-4 border rounded-lg cursor-pointer hover:bg-base-200">
                                            <input type="radio" name="pet_type" value="{{ $type }}"
                                                class="radio radio-primary" required onchange="runForwardChaining()">
                                            <div class="flex items-center">
                                                <i class="fas {{ $icon }} mr-2 text-xl"></i>
                                                <span>{{ $type }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Berat & Sifat -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-control">
                                    <label class="label mb-2">
                                        <span class="label-text font-semibold">4. Berat Peliharaan (kg) *</span>
                                    </label>
                                    <input type="number" name="pet_weight" id="petWeight" step="0.1"
                                        min="0.1" class="input input-bordered w-full" required
                                        oninput="runForwardChaining()">
                                </div>

                                <div class="form-control">
                                    <label class="label mb-2">
                                        <span class="label-text font-semibold">5. Sifat Peliharaan *</span>
                                    </label>
                                    <select name="temprament" id="petTemperament"
                                        class="select select-bordered w-full" required onchange="runForwardChaining()">
                                        <option value="">Pilih sifat</option>
                                        <option value="tenang">Tenang dan pendiam</option>
                                        <option value="aktif">Aktif dan energik</option>
                                        <option value="sangat_aktif">Sangat aktif dan lincah</option>
                                        <option value="pemalu">Pemalu dan sensitif</option>
                                        <option value="agresif">Agresif/butuh perhatian khusus</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rekomendasi Ruangan -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 border-b pb-2">
                            <i class="fas fa-magic mr-2 text-accent"></i>
                            6. Rekomendasi Ruangan (Hasil Sistem Pakar)
                        </h3>

                        <div id="systemRecommendation" class="hidden">
                            <div class="alert alert-info mb-4">
                                <div class="flex">
                                    <i class="fas fa-lightbulb mt-1 mr-3"></i>
                                    <div>
                                        <p>Sistem pakar telah menganalisis data hewan Anda. Rekomendasi:</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <!-- Standard Room -->
                                <label
                                    class="room-option flex flex-col items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:shadow-lg transition-all"
                                    data-room="standard">
                                    <input type="radio" name="room_type" value="standard" class="hidden">
                                    <div class="mb-3">
                                        <i class="fas fa-home text-3xl text-gray-500"></i>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-bold text-lg">STANDARD</div>
                                        <div class="text-sm text-gray-600 mt-1">Rp 60.000/hari</div>
                                        <div class="text-xs text-gray-500 mt-1">1x1 meter</div>
                                    </div>
                                    <div class="mt-3 recommendation-badge hidden">
                                        <div class="badge badge-success animate-bounce">
                                            <i class="fas fa-robot mr-1"></i> REKOMENDASI
                                        </div>
                                    </div>
                                </label>

                                <!-- Premium Room -->
                                <label
                                    class="room-option flex flex-col items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:shadow-lg transition-all"
                                    data-room="premium">
                                    <input type="radio" name="room_type" value="premium" class="hidden">
                                    <div class="mb-3">
                                        <i class="fas fa-star text-3xl text-yellow-500"></i>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-bold text-lg">PREMIUM</div>
                                        <div class="text-sm text-gray-600 mt-1">Rp 85.000/hari</div>
                                        <div class="text-xs text-gray-500 mt-1">2x2 meter</div>
                                    </div>
                                    <div class="mt-3 recommendation-badge hidden">
                                        <div class="badge badge-success animate-bounce">
                                            <i class="fas fa-robot mr-1"></i> REKOMENDASI
                                        </div>
                                    </div>
                                </label>

                                <!-- Luxury Room -->
                                <label
                                    class="room-option flex flex-col items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:shadow-lg transition-all"
                                    data-room="luxury">
                                    <input type="radio" name="room_type" value="luxury" class="hidden">
                                    <div class="mb-3">
                                        <i class="fas fa-crown text-3xl text-purple-500"></i>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-bold text-lg">LUXURY</div>
                                        <div class="text-sm text-gray-600 mt-1">Rp 150.000/hari</div>
                                        <div class="text-xs text-gray-500 mt-1">3x3 meter</div>
                                    </div>
                                    <div class="mt-3 recommendation-badge hidden">
                                        <div class="badge badge-success animate-bounce">
                                            <i class="fas fa-robot mr-1"></i> REKOMENDASI
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div id="recommendationReason" class="mt-4 p-4 bg-base-200 rounded-lg">
                                <h5 class="font-semibold mb-2">
                                    <i class="fas fa-info-circle mr-2 text-info"></i>
                                    Alasan Rekomendasi:
                                </h5>
                                <p id="reasonText" class="text-sm text-gray-700"></p>
                            </div>
                        </div>

                        <div id="noRecommendation" class="hidden">
                            <div class="alert alert-warning">
                                <div class="flex">
                                    <i class="fas fa-exclamation-triangle mt-1 mr-3"></i>
                                    <div>
                                        <p>Silakan lengkapi data hewan (poin 2-5) untuk mendapatkan rekomendasi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan Tambahan -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 border-b pb-2">
                            <i class="fas fa-concierge-bell mr-2 text-green-500"></i>
                            7. Layanan Tambahan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label
                                    class="flex items-center space-x-3 p-4 border rounded-lg cursor-pointer hover:bg-base-200">
                                    <input type="checkbox" name="bring_own_food" value="1"
                                        class="checkbox checkbox-primary">

                                    <div class="flex-1">
                                        <div class="font-medium">Makanan (bawa sendiri)</div>
                                        <div class="text-sm text-gray-500">Dapat diskon 30% dari total harga</div>
                                    </div>
                                    <div class="badge badge-success">Diskon 30%</div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Penginapan -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 border-b pb-2">
                            <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                            Tanggal Penginapan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">Check-in *</span>
                                </label>
                                <input type="date" name="check_in" id="checkIn" class="input input-bordered w-full"
                                    required onchange="updateCheckOutMin()">
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">Check-out *</span>
                                </label>
                                <input type="date" name="check_out" id="checkOut"
                                    class="input input-bordered w-full" required onchange="calculateTotal()">
                            </div>
                        </div>

                        <div id="durationInfo" class="mt-4 hidden">
                            <!-- Info durasi akan muncul di sini -->
                        </div>
                    </div>

                    <!-- Ringkasan Harga -->
                    <div class="mb-8">
                        <div class="card bg-base-200 border border-base-300">
                            <div class="card-body">
                                <h3 class="card-title">
                                    <i class="fas fa-calculator mr-2"></i>
                                    Ringkasan Harga
                                </h3>
                                <div id="priceSummary" class="space-y-2 mt-4">
                                    <div class="text-center py-4 text-gray-500">
                                        <i class="fas fa-calculator text-2xl mb-2"></i>
                                        <p>Harga akan ditampilkan setelah memilih ruangan dan tanggal</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="mb-8">
                        <div class="form-control flex flex-col">
                            <label class="label">
                                <span class="label-text font-semibold">Catatan Tambahan (Opsional)</span>
                            </label>
                            <textarea name="user_notes" class="textarea textarea-bordered h-32 w-full"
                                placeholder="Contoh: Alergi makanan, obat khusus, atau instruksi perawatan..."></textarea>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('user.pet-hotel.index') }}" class="btn btn-ghost">
                            <i class="fas fa-times mr-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calendar-check mr-2"></i> Buat Reservasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // ==================== SISTEM PAKAR FORWARD CHAINING ====================
        class ForwardChainingSystem {
            constructor() {
                this.workingMemory = new Set();
                this.rules = [];
                this.initializeRules();
            }

            // Inisialisasi aturan-aturan (Rule Base) - LENGKAP
            initializeRules() {
                // Bersihkan rules sebelumnya
                this.rules = [];

                // ==================== ITERASI 1: Konversi Input ke Fakta Dasar ====================
                // Aturan untuk berat
                this.rules.push({
                    iteration: 1,
                    id: 'R1',
                    condition: (data) => data.petWeight < 3,
                    conclusion: 'berat_ringan',
                    description: 'IF (berat < 3kg) THEN berat_ringan'
                });
                this.rules.push({
                    iteration: 1,
                    id: 'R2',
                    condition: (data) => data.petWeight >= 3 && data.petWeight <= 6,
                    conclusion: 'berat_sedang',
                    description: 'IF (3kg ≤ berat ≤ 6kg) THEN berat_sedang'
                });
                this.rules.push({
                    iteration: 1,
                    id: 'R3',
                    condition: (data) => data.petWeight > 6,
                    conclusion: 'berat_berat',
                    description: 'IF (berat > 6kg) THEN berat_berat'
                });

                // Aturan untuk sifat
                const sifatRules = [{
                        value: 'tenang',
                        id: 'R4',
                        conclusion: 'sifat_tenang'
                    },
                    {
                        value: 'aktif',
                        id: 'R5',
                        conclusion: 'sifat_aktif'
                    },
                    {
                        value: 'sangat_aktif',
                        id: 'R6',
                        conclusion: 'sifat_sangat_aktif'
                    },
                    {
                        value: 'pemalu',
                        id: 'R7',
                        conclusion: 'sifat_pemalu'
                    },
                    {
                        value: 'agresif',
                        id: 'R8',
                        conclusion: 'sifat_agresif'
                    }
                ];

                sifatRules.forEach(rule => {
                    this.rules.push({
                        iteration: 1,
                        id: rule.id,
                        condition: (data) => data.petTemperament === rule.value,
                        conclusion: rule.conclusion,
                        description: `IF (sifat = ${rule.value}) THEN ${rule.conclusion}`
                    });
                });

                // Aturan untuk jenis hewan
                const jenisRules = [{
                        value: 'Kucing',
                        id: 'R9',
                        conclusion: 'jenis_kucing'
                    },
                    {
                        value: 'Anjing',
                        id: 'R10',
                        conclusion: 'jenis_anjing'
                    },
                    {
                        value: 'Kelinci',
                        id: 'R11',
                        conclusion: 'jenis_kelinci'
                    }
                ];

                jenisRules.forEach(rule => {
                    this.rules.push({
                        iteration: 1,
                        id: rule.id,
                        condition: (data) => data.petType === rule.value,
                        conclusion: rule.conclusion,
                        description: `IF (jenis = ${rule.value}) THEN ${rule.conclusion}`
                    });
                });

                // ==================== ITERASI 2: Aturan Berdasarkan Berat & Sifat ====================
                // Aturan untuk hewan dengan berat ringan
                this.rules.push({
                    iteration: 2,
                    id: 'R12',
                    condition: (wm) => wm.has('berat_ringan') && wm.has('sifat_tenang'),
                    conclusion: 'kategori_ringan_tenang',
                    description: 'IF (berat_ringan AND sifat_tenang) THEN kategori_ringan_tenang'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R13',
                    condition: (wm) => wm.has('berat_ringan') && wm.has('sifat_pemalu'),
                    conclusion: 'kategori_ringan_pemalu',
                    description: 'IF (berat_ringan AND sifat_pemalu) THEN kategori_ringan_pemalu'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R14',
                    condition: (wm) => wm.has('berat_ringan') && wm.has('sifat_aktif'),
                    conclusion: 'kategori_ringan_aktif',
                    description: 'IF (berat_ringan AND sifat_aktif) THEN kategori_ringan_aktif'
                });

                // Aturan untuk hewan dengan berat sedang
                this.rules.push({
                    iteration: 2,
                    id: 'R15',
                    condition: (wm) => wm.has('berat_sedang') && wm.has('sifat_tenang'),
                    conclusion: 'kategori_sedang_tenang',
                    description: 'IF (berat_sedang AND sifat_tenang) THEN kategori_sedang_tenang'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R16',
                    condition: (wm) => wm.has('berat_sedang') && wm.has('sifat_pemalu'),
                    conclusion: 'kategori_sedang_pemalu',
                    description: 'IF (berat_sedang AND sifat_pemalu) THEN kategori_sedang_pemalu'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R17',
                    condition: (wm) => wm.has('berat_sedang') && wm.has('sifat_aktif'),
                    conclusion: 'kategori_sedang_aktif',
                    description: 'IF (berat_sedang AND sifat_aktif) THEN kategori_sedang_aktif'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R18',
                    condition: (wm) => wm.has('berat_sedang') && wm.has('sifat_sangat_aktif'),
                    conclusion: 'kategori_sedang_sangat_aktif',
                    description: 'IF (berat_sedang AND sifat_sangat_aktif) THEN kategori_sedang_sangat_aktif'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R19',
                    condition: (wm) => wm.has('berat_sedang') && wm.has('sifat_agresif'),
                    conclusion: 'kategori_sedang_agresif',
                    description: 'IF (berat_sedang AND sifat_agresif) THEN kategori_sedang_agresif'
                });

                // Aturan untuk hewan dengan berat berat
                this.rules.push({
                    iteration: 2,
                    id: 'R20',
                    condition: (wm) => wm.has('berat_berat') && wm.has('sifat_tenang'),
                    conclusion: 'kategori_berat_tenang',
                    description: 'IF (berat_berat AND sifat_tenang) THEN kategori_berat_tenang'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R21',
                    condition: (wm) => wm.has('berat_berat') && wm.has('sifat_pemalu'),
                    conclusion: 'kategori_berat_pemalu',
                    description: 'IF (berat_berat AND sifat_pemalu) THEN kategori_berat_pemalu'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R22',
                    condition: (wm) => wm.has('berat_berat') && wm.has('sifat_aktif'),
                    conclusion: 'kategori_berat_aktif',
                    description: 'IF (berat_berat AND sifat_aktif) THEN kategori_berat_aktif'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R23',
                    condition: (wm) => wm.has('berat_berat') && wm.has('sifat_sangat_aktif'),
                    conclusion: 'kategori_berat_sangat_aktif',
                    description: 'IF (berat_berat AND sifat_sangat_aktif) THEN kategori_berat_sangat_aktif'
                });
                this.rules.push({
                    iteration: 2,
                    id: 'R24',
                    condition: (wm) => wm.has('berat_berat') && wm.has('sifat_agresif'),
                    conclusion: 'kategori_berat_agresif',
                    description: 'IF (berat_berat AND sifat_agresif) THEN kategori_berat_agresif'
                });

                // ==================== ITERASI 3: Aturan untuk Kebutuhan Ruangan ====================
                // Aturan untuk ruangan kecil (STANDARD)
                this.rules.push({
                    iteration: 3,
                    id: 'R25',
                    condition: (wm) => wm.has('kategori_ringan_tenang') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_kecil',
                    description: 'IF (kategori_ringan_tenang AND jenis_kucing) THEN butuh_ruangan_kecil'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R26',
                    condition: (wm) => wm.has('kategori_ringan_tenang') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_kecil',
                    description: 'IF (kategori_ringan_tenang AND jenis_kelinci) THEN butuh_ruangan_kecil'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R27',
                    condition: (wm) => wm.has('kategori_ringan_pemalu') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_kecil',
                    description: 'IF (kategori_ringan_pemalu AND jenis_kucing) THEN butuh_ruangan_kecil'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R28',
                    condition: (wm) => wm.has('kategori_ringan_pemalu') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_kecil',
                    description: 'IF (kategori_ringan_pemalu AND jenis_kelinci) THEN butuh_ruangan_kecil'
                });

                // Aturan untuk ruangan sedang (PREMIUM)
                this.rules.push({
                    iteration: 3,
                    id: 'R29',
                    condition: (wm) => wm.has('kategori_ringan_aktif') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_ringan_aktif AND jenis_kucing) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R30',
                    condition: (wm) => wm.has('kategori_ringan_aktif') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_ringan_aktif AND jenis_kelinci) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R31',
                    condition: (wm) => wm.has('kategori_sedang_tenang') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_sedang_tenang AND jenis_kucing) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R32',
                    condition: (wm) => wm.has('kategori_sedang_tenang') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_sedang_tenang AND jenis_kelinci) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R33',
                    condition: (wm) => wm.has('kategori_sedang_pemalu') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_sedang_pemalu AND jenis_kucing) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R34',
                    condition: (wm) => wm.has('kategori_sedang_pemalu') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_sedang_pemalu AND jenis_kelinci) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R35',
                    condition: (wm) => wm.has('kategori_sedang_aktif') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_sedang_aktif AND jenis_kucing) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R36',
                    condition: (wm) => wm.has('kategori_sedang_aktif') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (kategori_sedang_aktif AND jenis_kelinci) THEN butuh_ruangan_sedang'
                });

                // Aturan untuk ruangan besar (LUXURY)
                this.rules.push({
                    iteration: 3,
                    id: 'R37',
                    condition: (wm) => wm.has('kategori_sedang_sangat_aktif') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_sedang_sangat_aktif AND jenis_kucing) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R38',
                    condition: (wm) => wm.has('kategori_sedang_sangat_aktif') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_sedang_sangat_aktif AND jenis_kelinci) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R39',
                    condition: (wm) => wm.has('kategori_sedang_agresif') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_sedang_agresif AND jenis_kucing) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R40',
                    condition: (wm) => wm.has('kategori_sedang_agresif') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_sedang_agresif AND jenis_kelinci) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R41',
                    condition: (wm) => wm.has('kategori_berat_tenang') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_tenang AND jenis_kucing) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R42',
                    condition: (wm) => wm.has('kategori_berat_tenang') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_tenang AND jenis_kelinci) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R43',
                    condition: (wm) => wm.has('kategori_berat_pemalu') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_pemalu AND jenis_kucing) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R44',
                    condition: (wm) => wm.has('kategori_berat_pemalu') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_pemalu AND jenis_kelinci) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R45',
                    condition: (wm) => wm.has('kategori_berat_aktif') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_aktif AND jenis_kucing) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R46',
                    condition: (wm) => wm.has('kategori_berat_aktif') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_aktif AND jenis_kelinci) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R47',
                    condition: (wm) => wm.has('kategori_berat_sangat_aktif') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_sangat_aktif AND jenis_kucing) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R48',
                    condition: (wm) => wm.has('kategori_berat_sangat_aktif') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_sangat_aktif AND jenis_kelinci) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R49',
                    condition: (wm) => wm.has('kategori_berat_agresif') && wm.has('jenis_kucing'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_agresif AND jenis_kucing) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R50',
                    condition: (wm) => wm.has('kategori_berat_agresif') && wm.has('jenis_kelinci'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (kategori_berat_agresif AND jenis_kelinci) THEN butuh_ruangan_besar'
                });

                // Aturan khusus untuk ANJING (semua anjing butuh ruangan lebih besar)
                this.rules.push({
                    iteration: 3,
                    id: 'R51',
                    condition: (wm) => wm.has('jenis_anjing') && (wm.has('kategori_ringan_tenang') || wm.has(
                        'kategori_ringan_pemalu')),
                    conclusion: 'butuh_ruangan_sedang',
                    description: 'IF (jenis_anjing AND (kategori_ringan_tenang OR kategori_ringan_pemalu)) THEN butuh_ruangan_sedang'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R52',
                    condition: (wm) => wm.has('jenis_anjing') && wm.has('kategori_ringan_aktif'),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (jenis_anjing AND kategori_ringan_aktif) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R53',
                    condition: (wm) => wm.has('jenis_anjing') && (wm.has('kategori_sedang_tenang') || wm.has(
                        'kategori_sedang_pemalu')),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (jenis_anjing AND (kategori_sedang_tenang OR kategori_sedang_pemalu)) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R54',
                    condition: (wm) => wm.has('jenis_anjing') && (wm.has('kategori_sedang_aktif') || wm.has(
                        'kategori_sedang_sangat_aktif') || wm.has('kategori_sedang_agresif')),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (jenis_anjing AND (kategori_sedang_aktif OR kategori_sedang_sangat_aktif OR kategori_sedang_agresif)) THEN butuh_ruangan_besar'
                });
                this.rules.push({
                    iteration: 3,
                    id: 'R55',
                    condition: (wm) => wm.has('jenis_anjing') && (wm.has('kategori_berat_tenang') || wm.has(
                        'kategori_berat_pemalu') || wm.has('kategori_berat_aktif') || wm.has(
                        'kategori_berat_sangat_aktif') || wm.has('kategori_berat_agresif')),
                    conclusion: 'butuh_ruangan_besar',
                    description: 'IF (jenis_anjing AND (kategori_berat_tenang OR kategori_berat_pemalu OR kategori_berat_aktif OR kategori_berat_sangat_aktif OR kategori_berat_agresif)) THEN butuh_ruangan_besar'
                });

                // ==================== ITERASI 4: Aturan untuk Rekomendasi Akhir ====================
                this.rules.push({
                    iteration: 4,
                    id: 'R56',
                    condition: (wm) => wm.has('butuh_ruangan_kecil'),
                    conclusion: 'standard',
                    description: 'IF (butuh_ruangan_kecil) THEN rekomendasi = STANDARD'
                });
                this.rules.push({
                    iteration: 4,
                    id: 'R57',
                    condition: (wm) => wm.has('butuh_ruangan_sedang'),
                    conclusion: 'premium',
                    description: 'IF (butuh_ruangan_sedang) THEN rekomendasi = PREMIUM'
                });
                this.rules.push({
                    iteration: 4,
                    id: 'R58',
                    condition: (wm) => wm.has('butuh_ruangan_besar'),
                    conclusion: 'luxury',
                    description: 'IF (butuh_ruangan_besar) THEN rekomendasi = LUXURY'
                });
                this.rules.push({
                    iteration: 4,
                    id: 'R59',
                    condition: (wm) => !wm.has('butuh_ruangan_kecil') && !wm.has('butuh_ruangan_sedang') && !wm
                        .has('butuh_ruangan_besar'),
                    conclusion: 'standard',
                    description: 'IF (tidak ada kebutuhan ruangan terdeteksi) THEN rekomendasi default = STANDARD'
                });
            }

            // Reset working memory
            clearMemory() {
                this.workingMemory.clear();
            }

            // Tambah fakta
            addFact(fact) {
                this.workingMemory.add(fact);
            }

            // Jalankan forward chaining dengan 4 iterasi
            forwardChain(data) {
                this.clearMemory();
                const process = {
                    iteration1: {
                        rules: [],
                        newFacts: []
                    },
                    iteration2: {
                        rules: [],
                        newFacts: []
                    },
                    iteration3: {
                        rules: [],
                        newFacts: []
                    },
                    iteration4: {
                        rules: [],
                        newFacts: []
                    }
                };

                // console.log("=== SISTEM PAKAR FORWARD CHAINING (4 ITERASI) ===");

                // Iterasi 1: Konversi input ke fakta
                // console.log("Iterasi 1: Konversi Input ke Fakta");
                this.rules.filter(r => r.iteration === 1).forEach(rule => {
                    if (rule.condition(data)) {
                        this.addFact(rule.conclusion);
                        process.iteration1.rules.push({
                            id: rule.id,
                            description: rule.description,
                            fired: true
                        });
                        process.iteration1.newFacts.push(rule.conclusion);
                    }
                });

                // Iterasi 2: Tentukan kategori berdasarkan berat dan sifat
                // console.log("Iterasi 2: Kategori Berat dan Sifat");
                this.rules.filter(r => r.iteration === 2).forEach(rule => {
                    if (rule.condition(this.workingMemory)) {
                        this.addFact(rule.conclusion);
                        process.iteration2.rules.push({
                            id: rule.id,
                            description: rule.description,
                            fired: true
                        });
                        process.iteration2.newFacts.push(rule.conclusion);
                    }
                });

                // Iterasi 3: Tentukan kebutuhan ruangan berdasarkan kategori dan jenis
                // console.log("Iterasi 3: Kebutuhan Ruangan");
                this.rules.filter(r => r.iteration === 3).forEach(rule => {
                    if (rule.condition(this.workingMemory)) {
                        this.addFact(rule.conclusion);
                        process.iteration3.rules.push({
                            id: rule.id,
                            description: rule.description,
                            fired: true
                        });
                        process.iteration3.newFacts.push(rule.conclusion);
                    }
                });

                // Iterasi 4: Rekomendasi akhir
                // console.log("Iterasi 4: Rekomendasi Akhir");
                let finalConclusion = null;
                this.rules.filter(r => r.iteration === 4).forEach(rule => {
                    if (rule.condition(this.workingMemory)) {
                        this.addFact(rule.conclusion);
                        process.iteration4.rules.push({
                            id: rule.id,
                            description: rule.description,
                            fired: true
                        });
                        process.iteration4.newFacts.push(rule.conclusion);
                        finalConclusion = rule.conclusion;
                    }
                });

                // console.log("Working Memory:", Array.from(this.workingMemory));
                // console.log("Kesimpulan Akhir:", finalConclusion);

                return {
                    process: process,
                    finalConclusion: finalConclusion,
                    workingMemory: Array.from(this.workingMemory)
                };
            }

            // Generate alasan rekomendasi
            generateReason(conclusion, workingMemory) {
                // let reason = "Berdasarkan analisis forward chaining dengan 59 aturan: ";
                let reason = "Berdasarkan analisis sistem kami: ";

                // Ambil fakta-fakta penting
                const berat = workingMemory.find(f => f.includes('berat_'));
                const sifat = workingMemory.find(f => f.includes('sifat_'));
                const jenis = workingMemory.find(f => f.includes('jenis_'));
                const kategori = workingMemory.find(f => f.includes('kategori_'));

                if (berat && sifat && jenis && kategori) {
                    const beratText = berat.replace('berat_', '');
                    const sifatText = sifat.replace('sifat_', '');
                    const jenisText = jenis.replace('jenis_', '');
                    const kategoriText = kategori.replace('kategori_', '').replace('_', ' ');

                    reason +=
                        `Hewan ${jenisText} dengan ${beratText} dan sifat ${sifatText} termasuk dalam kategori "${kategoriText}". `;

                    if (conclusion === 'standard') {
                        reason +=
                            `Kategori ini cocok dengan ruangan STANDARD (1x1 meter) yang nyaman untuk hewan kecil dengan sifat tenang.`;
                    } else if (conclusion === 'premium') {
                        reason +=
                            `Kategori ini membutuhkan ruangan PREMIUM (2x2 meter) untuk memberikan ruang gerak yang cukup.`;
                    } else if (conclusion === 'luxury') {
                        reason +=
                            `Kategori ini membutuhkan ruangan LUXURY (3x3 meter) dengan fasilitas lengkap untuk kenyamanan maksimal.`;
                    }
                } else {
                    reason += "Data hewan menunjukkan kebutuhan khusus yang sesuai dengan rekomendasi sistem.";
                }

                return reason;
            }
        }

        // ==================== GLOBAL VARIABLES ====================
        const expertSystem = new ForwardChainingSystem();
        let currentChainResult = null;

        // ==================== FUNGSI UTAMA ====================
        function collectPetData() {
            const petTypeInput = document.querySelector('input[name="pet_type"]:checked');
            const petWeight = parseFloat(document.getElementById('petWeight').value) || 0;
            const petTemperament = document.getElementById('petTemperament').value;

            return {
                petType: petTypeInput ? petTypeInput.value : null,
                petWeight: petWeight,
                petTemperament: petTemperament,
                petName: document.getElementById('petName').value,
                ownerName: document.getElementById('ownerName').value,
                ownerPhone: document.getElementById('ownerPhone').value
            };
        }

        function updateFacts() {
            const data = collectPetData();
            const factsDiv = document.getElementById('initialFacts');

            let factsHTML = '';
            if (data.petType) factsHTML += `<span class="fact-tag">Jenis: ${data.petType}</span>`;
            if (data.petWeight > 0) factsHTML += `<span class="fact-tag">Berat: ${data.petWeight}kg</span>`;
            if (data.petTemperament) {
                const tempNames = {
                    'tenang': 'Tenang',
                    'aktif': 'Aktif',
                    'sangat_aktif': 'Sangat Aktif',
                    'pemalu': 'Pemalu',
                    'agresif': 'Agresif'
                };
                factsHTML += `<span class="fact-tag">Sifat: ${tempNames[data.petTemperament]}</span>`;
            }
            if (data.petName) factsHTML += `<span class="fact-tag">Nama: ${data.petName}</span>`;
            if (data.ownerName) factsHTML += `<span class="fact-tag">Pemilik: ${data.ownerName}</span>`;

            factsDiv.innerHTML = factsHTML || '<div class="text-gray-300">Data belum lengkap</div>';
        }

        function runForwardChaining() {
            const data = collectPetData();

            // Validasi data minimal untuk sistem pakar
            if (!data.petType || !data.petTemperament || data.petWeight <= 0) {
                document.getElementById('systemRecommendation').classList.add('hidden');
                document.getElementById('noRecommendation').classList.remove('hidden');
                document.getElementById('forwardChainProcess').classList.add('hidden');
                document.getElementById('conclusionSection').classList.add('hidden');
                return;
            }

            // Update initial facts display
            updateFacts();

            // Tampilkan loading
            document.getElementById('loadingProcess').classList.remove('hidden');
            document.getElementById('forwardChainProcess').classList.add('hidden');
            document.getElementById('conclusionSection').classList.add('hidden');

            // Simulasi delay untuk proses
            setTimeout(() => {
                // Jalankan forward chaining
                const result = expertSystem.forwardChain(data);
                currentChainResult = result;

                // Sembunyikan loading
                document.getElementById('loadingProcess').classList.add('hidden');

                // Tampilkan proses forward chaining
                displayForwardChainProcess(result.process);

                // Tampilkan kesimpulan
                if (result.finalConclusion) {
                    displayConclusion(result.finalConclusion);
                    updateRoomRecommendation(result.finalConclusion, result.workingMemory);
                }

                // Tampilkan section rekomendasi
                document.getElementById('systemRecommendation').classList.remove('hidden');
                document.getElementById('noRecommendation').classList.add('hidden');
            }, 1000);
        }

        // Update fungsi displayForwardChainProcess untuk 4 iterasi
        function displayForwardChainProcess(process) {
            const forwardChainDiv = document.getElementById('forwardChainProcess');
            forwardChainDiv.classList.remove('hidden');

            // Clear previous content
            ['iteration1Rules', 'iteration2Rules', 'iteration3Rules', 'iteration4Rules'].forEach(id => {
                document.getElementById(id).innerHTML = '';
            });

            ['iteration1Facts', 'iteration2Facts', 'iteration3Facts', 'iteration4Facts'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });

            // Display iteration 1
            displayIteration(1, process.iteration1);

            // Display iteration 2 after delay
            setTimeout(() => {
                if (process.iteration2.rules.length > 0) {
                    displayIteration(2, process.iteration2);
                }
            }, process.iteration1.rules.length * 300 + 500);

            // Display iteration 3 after delay
            setTimeout(() => {
                if (process.iteration3.rules.length > 0) {
                    displayIteration(3, process.iteration3);
                }
            }, (process.iteration1.rules.length + process.iteration2.rules.length) * 300 + 1000);

            // Display iteration 4 after delay
            setTimeout(() => {
                if (process.iteration4.rules.length > 0) {
                    displayIteration(4, process.iteration4);
                }
            }, (process.iteration1.rules.length + process.iteration2.rules.length + process.iteration3.rules
                .length) * 300 + 1500);
        }

        // Fungsi untuk menampilkan setiap iterasi
        function displayIteration(iterationNumber, iterationData) {
            const rulesDiv = document.getElementById(`iteration${iterationNumber}Rules`);
            const factsDiv = document.getElementById(`iteration${iterationNumber}Facts`);

            if (!rulesDiv || !factsDiv) return;

            // Display rules
            iterationData.rules.forEach((rule, index) => {
                setTimeout(() => {
                    const ruleDiv = document.createElement('div');
                    ruleDiv.className = 'rule-execution';
                    ruleDiv.innerHTML = `
                <div class="flex items-start">
                    <span class="step-badge">${rule.id}</span>
                    <div class="flex-1">
                        <div class="font-semibold">${rule.description}</div>
                    </div>
                    <div class="ml-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                </div>
            `;
                    rulesDiv.appendChild(ruleDiv);

                    // Animation
                    setTimeout(() => {
                        ruleDiv.classList.add('firing');
                        setTimeout(() => ruleDiv.classList.remove('firing'), 500);
                    }, 100);
                }, index * 300);
            });

            // Display new facts after rules are shown
            setTimeout(() => {
                if (iterationData.newFacts.length > 0) {
                    factsDiv.classList.remove('hidden');
                    const factTagsDiv = factsDiv.querySelector('.fact-tags') || factsDiv;

                    // Clear and add new facts
                    if (factsDiv.querySelector('.fact-tags')) {
                        factsDiv.querySelector('.fact-tags').innerHTML = '';
                    }

                    iterationData.newFacts.forEach((fact, index) => {
                        setTimeout(() => {
                            const factTag = document.createElement('span');
                            factTag.className = 'fact-tag';
                            factTag.textContent = fact;

                            if (factsDiv.querySelector('.fact-tags')) {
                                factsDiv.querySelector('.fact-tags').appendChild(factTag);
                            } else {
                                factsDiv.appendChild(factTag);
                            }
                        }, index * 200);
                    });
                }
            }, iterationData.rules.length * 300);
        }

        function displayIteration(iterationNumber, iterationData) {
            const rulesDiv = document.getElementById(`iteration${iterationNumber}Rules`);
            const factsDiv = document.getElementById(`iteration${iterationNumber}Facts`);
            const factsTagsDiv = factsDiv.querySelector('.fact-tags');

            // Clear
            factsTagsDiv.innerHTML = '';

            // Display rules
            iterationData.rules.forEach((rule, index) => {
                setTimeout(() => {
                    const ruleDiv = document.createElement('div');
                    ruleDiv.className = 'rule-execution';
                    ruleDiv.innerHTML = `
                <div class="flex items-start">
                    <span class="step-badge">${rule.id}</span>
                    <div class="flex-1">
                        <div class="font-semibold">${rule.description}</div>
                    </div>
                    <div class="ml-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                </div>
            `;
                    rulesDiv.appendChild(ruleDiv);

                    // Animation
                    setTimeout(() => {
                        ruleDiv.classList.add('firing');
                        setTimeout(() => ruleDiv.classList.remove('firing'), 500);
                    }, 100);
                }, index * 500);
            });

            // Display new facts
            setTimeout(() => {
                if (iterationData.newFacts.length > 0) {
                    factsDiv.classList.remove('hidden');
                    iterationData.newFacts.forEach((fact, index) => {
                        setTimeout(() => {
                            const factTag = document.createElement('span');
                            factTag.className = 'fact-tag';
                            factTag.textContent = fact;
                            factsTagsDiv.appendChild(factTag);
                        }, index * 300);
                    });
                }
            }, iterationData.rules.length * 500);
        }

        function displayConclusion(conclusion) {
            const conclusionSection = document.getElementById('conclusionSection');
            const finalConclusionDiv = document.getElementById('finalConclusion');

            conclusionSection.classList.remove('hidden');

            let conclusionText = '';
            let conclusionReason = '';

            if (conclusion === 'standard') {
                conclusionText = 'REKOMENDASI: <span class="font-bold text-white">RUANGAN STANDARD</span>';
                conclusionReason = 'Hewan dengan berat ringan dan sifat tenang/pemalu cocok dengan ruangan standard';
            } else if (conclusion === 'premium') {
                conclusionText = 'REKOMENDASI: <span class="font-bold text-white">RUANGAN PREMIUM</span>';
                conclusionReason = 'Hewan dengan berat sedang, jenis anjing, atau sifat aktif membutuhkan ruangan premium';
            } else if (conclusion === 'luxury') {
                conclusionText = 'REKOMENDASI: <span class="font-bold text-white">RUANGAN LUXURY</span>';
                conclusionReason =
                    'Hewan dengan berat berat, sifat sangat aktif, atau sifat agresif membutuhkan ruangan luxury';
            }

            finalConclusionDiv.innerHTML = conclusionText;
            document.getElementById('conclusionReason').textContent = conclusionReason;
        }

        function updateRoomRecommendation(roomType, workingMemory) {
            // Update radio button
            const radioInput = document.querySelector(`input[name="room_type"][value="${roomType}"]`);
            if (radioInput) {
                radioInput.checked = true;
            }

            // Update UI selection
            document.querySelectorAll('.room-option').forEach(option => {
                option.classList.remove('selected');
                option.querySelector('.recommendation-badge').classList.add('hidden');

                if (option.dataset.room === roomType) {
                    option.classList.add('selected');
                    option.querySelector('.recommendation-badge').classList.remove('hidden');
                }
            });

            // Update reason text
            const reason = expertSystem.generateReason(roomType, workingMemory);
            document.getElementById('reasonText').textContent = reason;

            // Calculate price
            calculateTotal();
        }

        // ==================== FUNGSI HARGA & TANGGAL ====================
        function updateCheckOutMin() {
            const checkIn = document.getElementById('checkIn').value;
            if (checkIn) {
                const checkOutInput = document.getElementById('checkOut');
                const minDate = new Date(checkIn);
                minDate.setDate(minDate.getDate() + 1);
                checkOutInput.min = minDate.toISOString().split('T')[0];

                // Reset check-out if invalid
                if (new Date(checkOutInput.value) <= new Date(checkIn)) {
                    checkOutInput.value = '';
                }
            }
        }

        function calculateTotal() {
            const roomTypeInput = document.querySelector('input[name="room_type"]:checked');
            const bringOwnFood = document.querySelector('input[name="bring_own_food"]');
            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;
            const durationDiv = document.getElementById('durationInfo');

            if (!roomTypeInput || !checkIn || !checkOut) return;

            // Calculate days
            const checkInDate = new Date(checkIn);
            const checkOutDate = new Date(checkOut);
            const timeDiff = checkOutDate.getTime() - checkInDate.getTime();
            const totalDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (totalDays <= 0) {
                durationDiv.innerHTML = '<div class="alert alert-error">Check-out harus setelah check-in</div>';
                return;
            }

            // Update duration info
            const options = {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            durationDiv.innerHTML = `
        <div class="alert alert-info">
            <div class="flex items-center">
                <i class="fas fa-calendar-day mr-3"></i>
                <div>
                    <span class="font-semibold">Durasi:</span> ${totalDays} hari
                    (${checkInDate.toLocaleDateString('id-ID', options)} - ${checkOutDate.toLocaleDateString('id-ID', options)})
                </div>
            </div>
        </div>
    `;
            durationDiv.classList.remove('hidden');

            // Calculate price
            const roomPrices = {
                'standard': 60000,
                'premium': 85000,
                'luxury': 150000
            };

            const roomType = roomTypeInput.value;
            const pricePerDay = roomPrices[roomType];
            const basePrice = pricePerDay * totalDays;
            const discount = bringOwnFood && bringOwnFood.checked ? basePrice * 0.3 : 0;
            const totalPrice = basePrice - discount;

            // Update price summary
            const priceSummary = document.getElementById('priceSummary');
            priceSummary.innerHTML = `
        <div class="space-y-2">
            <div class="flex justify-between">
                <span>${roomType.toUpperCase()} (${totalDays} hari)</span>
                <span class="font-semibold">Rp ${(pricePerDay * totalDays).toLocaleString()}</span>
            </div>
            ${discount > 0 ? `
                        <div class="flex justify-between text-green-600">
                            <span>Diskon Makanan (30%)</span>
                            <span class="font-semibold">- Rp ${discount.toLocaleString()}</span>
                        </div>
                        ` : ''}
            <div class="divider my-2"></div>
            <div class="flex justify-between text-lg font-bold">
                <span>Total Harga</span>
                <span class="text-primary text-xl" name="total_price">Rp ${totalPrice.toLocaleString()}</span>
                <input type="hidden" name="total_price" value="${totalPrice}">
            </div>
        </div>
    `;
        }

        // ==================== EVENT LISTENERS ====================
        document.addEventListener('DOMContentLoaded', function() {
            // Set minimum date for check-in (tomorrow)
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById('checkIn').min = tomorrow.toISOString().split('T')[0];

            // Room selection event
            document.querySelectorAll('.room-option').forEach(option => {
                option.addEventListener('click', function() {
                    const roomType = this.dataset.room;
                    const radioInput = this.querySelector('input[type="radio"]');
                    radioInput.checked = true;

                    // Update UI
                    document.querySelectorAll('.room-option').forEach(opt => {
                        opt.classList.remove('selected');
                        opt.querySelector('.recommendation-badge').classList.add('hidden');
                    });

                    this.classList.add('selected');

                    // Calculate price
                    calculateTotal();
                });
            });

            // Bring own food checkbox event
            const bringOwnFoodCheckbox = document.querySelector('input[name="bring_own_food"]');
            if (bringOwnFoodCheckbox) {
                bringOwnFoodCheckbox.addEventListener('change', function() {
                    calculateTotal();
                });
            }

            // Promo package event
            const promoSelect = document.querySelector('select[name="promo_package"]');
            if (promoSelect) {
                promoSelect.addEventListener('change', function() {
                    if (this.value === 'Sesuai Rekomendasi' && currentChainResult) {
                        // Determine recommended promo based on room
                        const roomType = document.querySelector('input[name="room_type"]:checked')
                            ?.value;
                        let recommendedPromo = '';

                        if (roomType === 'standard') {
                            recommendedPromo = 'Long Stay Discount';
                        } else if (roomType === 'premium') {
                            recommendedPromo = 'Weekend Special';
                        } else if (roomType === 'luxury') {
                            recommendedPromo = 'Grooming Package';
                        }

                        if (recommendedPromo) {
                            this.value = recommendedPromo;
                            showAlert('info', `Sistem merekomendasikan: ${recommendedPromo}`);
                        }
                    }
                });
            }
        });

        // Form validation
        document.getElementById('petHotelForm').addEventListener('submit', function(e) {
            const requiredFields = [
                'owner_name', 'owner_phone', 'pet_name', 'pet_type',
                'pet_weight', 'temprament', 'room_type',
                'check_in', 'check_out'
            ];

            let isValid = true;

            requiredFields.forEach(fieldName => {
                const field = this.querySelector(`[name="${fieldName}"]`);
                if (!field || !field.value.trim()) {
                    field?.classList.add('input-error');
                    isValid = false;
                } else {
                    field?.classList.remove('input-error');
                }
            });

            // Check radio buttons for pet_type
            const petTypeSelected = document.querySelector('input[name="pet_type"]:checked');
            if (!petTypeSelected) {
                showAlert('error', 'Silakan pilih jenis hewan');
                isValid = false;
            }

            // Check radio buttons for room_type
            const roomSelected = document.querySelector('input[name="room_type"]:checked');
            if (!roomSelected) {
                showAlert('error', 'Silakan pilih rekomendasi ruangan');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                showAlert('error', 'Silakan lengkapi semua field yang wajib diisi');
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });

        function showAlert(type, message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} fixed top-4 right-4 z-50 max-w-sm`;
            alertDiv.innerHTML = `
        <div class="flex">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} mt-1 mr-3"></i>
            <span>${message}</span>
        </div>
    `;
            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }
    </script>
@endsection
