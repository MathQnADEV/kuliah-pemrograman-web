@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <style>
        .login-bg {
            background: linear-gradient(135deg, #8B5FBF 0%, #6DBEFF 100%);
            min-height: 100vh;
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>
@endsection

@section('content')
    <section class="py-24   ">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <!-- Messages -->
                @if (session('success'))
                    <div class="alert alert-success mb-6">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Card -->
                <div class="card login-card shadow-2xl">
                    <div class="card-body p-8">
                        <!-- Logo -->
                        <div class="text-center mb-8">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary text-white mb-4">
                                <i class="fas fa-paw text-3xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold">Masuk ke Akun Anda</h2>
                            <p class="text-gray-600 mt-2">Silakan masuk untuk mengakses semua fitur</p>
                        </div>

                        <!-- Google Login Button -->
                        <div class="mb-6">
                            <a href="{{ route('login.google') }}" class="btn btn-outline btn-lg w-full hover:bg-gray-50">
                                <div class="flex items-center justify-center">
                                    <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5 mr-3" />
                                    <span>Lanjutkan dengan Google</span>
                                </div>
                            </a>
                            <p class="text-xs text-gray-500 text-center mt-2">Rekomendasi untuk pengalaman terbaik</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

