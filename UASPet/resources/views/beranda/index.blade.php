@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section id="home" class="min-h-screen flex items-center justify-center hero-gradient py-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <!-- Teks -->
                <div class="flex-1 text-center lg:text-left mb-10 lg:mb-0">
                    <h2 class="text-2xl md:text-3xl font-medium mb-4 text-shadow">Selamat datang</h2>
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-8 text-shadow leading-tight">
                        di Pet's Hotel & <br />
                        <span class="text-secondary">Adoption Center</span>
                    </h1>
                    <p class="text-xl md:text-2xl max-w-2xl mx-auto lg:mx-0 mb-10 text-shadow">
                        Tempat Penginapan peliharaan terbaik dan pencarian partner sejati untuk anda
                    </p>
                </div>
                <!-- Gambar Kucing -->
                <div class="flex-1 flex justify-center lg:justify-end">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                             alt="Happy Cat"
                             class="rounded-2xl shadow-2xl max-w-md w-full lg:max-w-lg transform transition hover:scale-105 duration-300" />
                        <!-- Efek dekoratif -->
                        <div class="absolute -bottom-5 -left-5 w-24 h-24 bg-secondary rounded-full opacity-20 z-0"></div>
                        <div class="absolute -top-5 -right-5 w-16 h-16 bg-accent rounded-full opacity-30 z-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Layanan Kami</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Kami menawarkan berbagai layanan terbaik untuk memastikan hewan peliharaan Anda bahagia dan sehat.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="rounded-full bg-primary p-6 text-white">
                            <i class="fas fa-hotel text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Pet Hotel</h3>
                        <p>Penginapan nyaman untuk hewan peliharaan Anda dengan fasilitas lengkap, makanan bergizi, dan perawatan penuh kasih.</p>
                        <div class="card-actions">
                            <a href="/pet-hotel">
                                <button class="btn btn-primary">Selengkapnya</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="rounded-full bg-secondary p-6 text-white">
                            <i class="fas fa-paw text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Pet Adopt</h3>
                        <p>Adopsi hewan peliharaan yang layak dengan tim ahli kami. Setiap hewan mendapatkan perawatan dan perhatian yang diperlukan.</p>
                        <div class="card-actions">
                            <a href="/adopsi">
                                <button class="btn btn-primary">Selengkapnya</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="rounded-full bg-accent p-6 text-white">
                            <i class="fa-solid fa-bullhorn text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Coming Soon</h3>
                        <p>Tungguin layanan service kami....</p>
                        <div class="card-actions">
                            <button class="btn btn-primary">Coming Soon</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Apa Kata Pelanggan Kami</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Kepuasan pelanggan adalah prioritas utama kami.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <div class="flex items-center mb-4">
                            <div class="avatar mr-4">
                                <div class="w-12 rounded-full ring ring-primary ring-offset-2 ring-offset-base-100">
                                    <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Customer" />
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold">Sari Dewi</h4>
                                <div class="rating rating-sm">
                                    <input type="radio" name="rating-1" class="mask mask-star" checked />
                                    <input type="radio" name="rating-1" class="mask mask-star" checked />
                                    <input type="radio" name="rating-1" class="mask mask-star" checked />
                                    <input type="radio" name="rating-1" class="mask mask-star" checked />
                                    <input type="radio" name="rating-1" class="mask mask-star" checked />
                                </div>
                            </div>
                        </div>
                        <p>"Saya sangat puas dengan layanan Pet Hotel. Kucing saya dirawat dengan sangat baik saat saya liburan. Terima kasih!"</p>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <div class="flex items-center mb-4">
                            <div class="avatar mr-4">
                                <div class="w-12 rounded-full ring ring-primary ring-offset-2 ring-offset-base-100">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer" />
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold">Budi Santoso</h4>
                                <div class="rating rating-sm">
                                    <input type="radio" name="rating-2" class="mask mask-star" checked />
                                    <input type="radio" name="rating-2" class="mask mask-star" checked />
                                    <input type="radio" name="rating-2" class="mask mask-star" checked />
                                    <input type="radio" name="rating-2" class="mask mask-star" checked />
                                    <input type="radio" name="rating-2" class="mask mask-star" checked />
                                </div>
                            </div>
                        </div>
                        <p>"Proses adopsi di sini sangat mudah dan transparan. Sekarang saya memiliki teman setia, Max, yang sangat saya sayangi."</p>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <div class="flex items-center mb-4">
                            <div class="avatar mr-4">
                                <div class="w-12 rounded-full ring ring-primary ring-offset-2 ring-offset-base-100">
                                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Customer" />
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold">Rina Amelia</h4>
                                <div class="rating rating-sm">
                                    <input type="radio" name="rating-3" class="mask mask-star" checked />
                                    <input type="radio" name="rating-3" class="mask mask-star" checked />
                                    <input type="radio" name="rating-3" class="mask mask-star" checked />
                                    <input type="radio" name="rating-3" class="mask mask-star" checked />
                                    <input type="radio" name="rating-3" class="mask mask-star" checked />
                                </div>
                            </div>
                        </div>
                        <p>"Layanan groomingnya profesional dan harganya terjangkau. Anjing saya selalu senang setelah grooming di sini."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Hubungi Kami</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Punya pertanyaan atau ingin membuat reservasi? Jangan ragu untuk menghubungi kami.</p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold">Alamat</h4>
                                <p>Jl. Kucing Bahagia No. 123, Jakarta Selatan</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone text-primary mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold">Telepon</h4>
                                <p>(021) 1234-5678</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-envelope text-primary mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold">Email</h4>
                                <p>info@pethoteladopt.com</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-clock text-primary mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold">Jam Operasional</h4>
                                <p>Senin - Minggu: 08.00 - 20.00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-bold mb-4">Ikuti Kami</h4>
                        <div class="flex gap-4">
                            <a class="btn btn-circle btn-outline btn-primary">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-circle btn-outline btn-primary">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                            <a class="btn btn-circle btn-outline btn-primary">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-2xl mb-4">Kirim Pesan</h3>
                        <form class="space-y-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nama Lengkap</span>
                                </label>
                                <input type="text" placeholder="Nama Anda" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" placeholder="email@example.com" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Subjek</span>
                                </label>
                                <input type="text" placeholder="Subjek pesan" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Pesan</span>
                                </label>
                                <textarea class="textarea textarea-bordered h-24" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>
                            <div class="form-control mt-6">
                                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
