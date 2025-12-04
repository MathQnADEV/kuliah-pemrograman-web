@extends('layouts.app')

@section('title', 'Pet Hotel')

@section('styles')
    <style>
        .hero-hotel {
            background: linear-gradient(rgba(139, 95, 191, 0.9), rgba(139, 95, 191, 0.8)),
                url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1586&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .facility-icon {
            transition: all 0.3s ease;
        }

        .facility-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }

        .room-card {
            transition: all 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <section class="hero min-h-[60vh] text-white hero-hotel">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center">
            <div class="max-w-4xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Pet Hotel Premium</h1>
                <p class="text-xl md:text-2xl mb-8">Penginapan mewah dengan fasilitas lengkap untuk hewan peliharaan
                    kesayangan Anda</p>
                <a href="{{ route('user.pet-hotel.create') }}" class="btn btn-secondary btn-lg text-white px-8 py-3 rounded-full">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1">
                    <h2 class="text-4xl font-bold mb-6 text-primary">Kenyamanan Terbaik untuk Hewan Peliharaan Anda</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Pet Hotel kami menyediakan penginapan terbaik untuk hewan peliharaan Anda saat Anda sedang bepergian
                        atau sibuk dengan pekerjaan.
                        Dengan fasilitas lengkap dan staf profesional, kami memastikan hewan peliharaan Anda mendapatkan
                        perawatan terbaik.
                    </p>
                    <p class="text-lg text-gray-600 mb-8">
                        Setiap hewan mendapatkan perhatian penuh kasih, makanan bergizi, dan aktivitas menyenangkan untuk
                        menjaga kebahagiaan
                        dan kesehatan mereka selama menginap di hotel kami.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                            <span class="text-gray-700">24/7 Pengawasan</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                            <span class="text-gray-700">Makanan Premium</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                            <span class="text-gray-700">Aktivitas Harian</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                            <span class="text-gray-700">Konsultasi Kesehatan</span>
                        </div>
                    </div>
                    <a href="#facilities" class="btn btn-primary btn-lg">Lihat Fasilitas</a>
                </div>
                <div class="flex-1">
                    <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=871&q=80"
                        alt="Pet Hotel Room"
                        class="rounded-2xl shadow-2xl w-full h-96 object-cover transform transition hover:scale-105 duration-300" />
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Fasilitas Unggulan</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Kami menyediakan berbagai fasilitas terbaik untuk
                kenyamanan hewan peliharaan Anda</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Facility 1 -->
                <div class="card bg-base-100 shadow-xl facility-icon">
                    <figure class="px-10 pt-10">
                        <div class="rounded-full bg-primary p-6 text-white">
                            <i class="fas fa-bed text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Kamar Nyaman</h3>
                        <p class="text-gray-600">Kamar tidur bersih dan nyaman dengan pengaturan suhu yang sesuai untuk
                            hewan peliharaan</p>
                    </div>
                </div>

                <!-- Facility 2 -->
                <div class="card bg-base-100 shadow-xl facility-icon">
                    <figure class="px-10 pt-10">
                        <div class="rounded-full bg-secondary p-6 text-white">
                            <i class="fas fa-utensils text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Makanan Premium</h3>
                        <p class="text-gray-600">Makanan bergizi dengan pilihan khusus sesuai kebutuhan diet hewan
                            peliharaan Anda</p>
                    </div>
                </div>

                <!-- Facility 3 -->
                <div class="card bg-base-100 shadow-xl facility-icon">
                    <figure class="px-10 pt-10">
                        <div class="rounded-full bg-accent p-6 text-white">
                            <i class="fas fa-gamepad text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Area Bermain</h3>
                        <p class="text-gray-600">Area bermain luas dengan berbagai mainan untuk menjaga hewan peliharaan
                            tetap aktif</p>
                    </div>
                </div>

                <!-- Facility 4 -->
                <div class="card bg-base-100 shadow-xl facility-icon">
                    <figure class="px-10 pt-10">
                        <div class="rounded-full bg-green-500 p-6 text-white">
                            <i class="fas fa-user-md text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Perawatan Kesehatan</h3>
                        <p class="text-gray-600">Pemeriksaan kesehatan rutin dan akses cepat ke dokter hewan jika diperlukan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Room Packages -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Paket Penginapan</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Pilih paket yang sesuai dengan kebutuhan hewan
                peliharaan Anda</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Package 1 -->
                <div class="card bg-base-100 shadow-xl room-card border border-gray-200">
                    <div class="card-body">
                        <div class="text-center mb-6">
                            <h3 class="card-title text-2xl text-primary">Paket Standard</h3>
                            <div class="mt-4">
                                <span class="text-4xl font-bold">Rp 60.000</span>
                                <span class="text-gray-500">/hari</span>
                            </div>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Kamar luas 1x1 meter</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Ruangan ber-AC dengan humidifier sebagai pelembab udara yang aman</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Menggunakan pakan PROPLAN</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Menggunakan pasir gumpal yang aman</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Terdapat mainan hewan didalam ruangan</span>
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-times mr-3"></i>
                                <span>Konsultasi kesehatan</span>
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-times mr-3"></i>
                                <span>Playtime secara private</span>
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-times mr-3"></i>
                                <span>
                                    Terdapat mezanine floor dan hiding spot untuk hewan bersantai</span>
                            </li>
                        </ul>
                        <div class="card-actions">
                            <a href="{{ route('user.pet-hotel.create') }}" class="btn btn-primary w-full">Pilih Paket</a>
                        </div>
                    </div>
                </div>

                <!-- Package 2 (Featured) -->
                <div class="card bg-base-100 shadow-2xl room-card border-2 border-primary relative">
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <div class="badge badge-primary px-4 py-2 font-bold text-white">POPULER</div>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-6">
                            <h3 class="card-title text-2xl text-primary">Paket Premium</h3>
                            <div class="mt-4">
                                <span class="text-4xl font-bold">Rp 85.000</span>
                                <span class="text-gray-500">/hari</span>
                            </div>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Kamar luas 2x2 meter</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Ruangan ber-AC dengan humidifier sebagai pelembab udara yang aman. Dengan ventilasi
                                    udara dan pintu kaca untuk pencahayaan sinar matahari</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Menggunakan pakan PROPLAN, creamy snacks, dan vitamin jilat</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Menggunakan pasir gumpal yang aman</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Playtime secara private</span>
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-times mr-3"></i>
                                <span>Konsultasi kesehatan</span>
                            </li>
                        </ul>
                        <div class="card-actions">
                            <a href="{{ route('user.pet-hotel.create') }}" class="btn btn-primary w-full">Pilih Paket</a>
                        </div>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="card bg-base-100 shadow-xl room-card border border-gray-200">
                    <div class="card-body">
                        <div class="text-center mb-6">
                            <h3 class="card-title text-2xl text-primary">Paket Luxury</h3>
                            <div class="mt-4">
                                <span class="text-4xl font-bold">Rp 150.000</span>
                                <span class="text-gray-500">/hari</span>
                            </div>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Kamar luas 3x3 meter</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Ruangan ber-AC dengan humidifier sebagai pelembab udara yang aman. Dengan ventilasi
                                    udara dan pintu kaca untuk pencahayaan sinar matahari</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Makanan khusus sesuai request + vitamin jilat nutriplus virbac</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Playtime secara private</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Konsultasi kesehatan</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                <span>Terdapat mezanine floor dan hiding spot untuk hewan bersantai</span>
                            </li>
                        </ul>
                        <div class="card-actions">
                            <a href="{{ route('user.pet-hotel.create') }}" class="btn btn-primary w-full">Pilih Paket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Temukan jawaban untuk pertanyaan umum tentang
                layanan Pet Hotel kami</p>

            <div class="max-w-3xl mx-auto">
                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" checked="checked" />
                    <div class="collapse-title text-xl font-medium">
                        Hewan apa saja yang bisa menginap di Pet Hotel?
                    </div>
                    <div class="collapse-content">
                        <p>Kami menerima berbagai jenis hewan peliharaan termasuk anjing, kucing, kelinci, burung, dan hewan
                            kecil lainnya. Untuk hewan eksotis atau hewan dengan kebutuhan khusus, silakan hubungi kami
                            terlebih dahulu untuk konsultasi.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apa yang harus dibawa saat check-in?
                    </div>
                    <div class="collapse-content">
                        <p>Kami menyarankan untuk membawa makanan favorit hewan Anda (opsional), mainan kesayangan, selimut,
                            dan catatan medis jika ada. Kami menyediakan semua kebutuhan dasar termasuk tempat tidur,
                            makanan, dan mainan.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah ada dokter hewan yang siap 24 jam?
                    </div>
                    <div class="collapse-content">
                        <p>Ya, kami bekerja sama dengan klinik hewan 24 jam yang siap membantu jika diperlukan. Selain itu,
                            staf kami terlatih dalam pertolongan pertama untuk hewan dan melakukan pemeriksaan kesehatan
                            rutin.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 mb-4 border border-gray-300">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Bisakah saya mengunjungi hewan saya selama menginap?
                    </div>
                    <div class="collapse-content">
                        <p>Tentu saja! Kami mendorong pemilik untuk mengunjungi hewan peliharaan mereka. Untuk kenyamanan
                            semua hewan, kami memiliki jam kunjungan khusus. Selain itu, kami menyediakan layanan video call
                            untuk paket Premium dan Luxury.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
