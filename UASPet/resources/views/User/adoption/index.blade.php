@extends('layouts.app')

@section('title', 'Adopsi Saya - Pet Hotel & Adopt')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">Adopsi Saya</h1>
            <p class="text-gray-600">Kelola semua aplikasi adopsi Anda</p>
        </div>
        <a href="{{ route('user.adoption.create') }}" class="btn btn-secondary">
            <i class="fas fa-plus mr-2"></i> Ajukan Adopsi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card aplikasi adopsi akan ditampilkan di sini -->
        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <h3 class="card-title">Belum Ada Aplikasi</h3>
                <p class="text-gray-600 mb-4">Mulai ajukan aplikasi adopsi pertama Anda</p>
                <div class="card-actions">
                    <a href="{{ route('user.adoption.create') }}" class="btn btn-secondary btn-sm">Ajukan Adopsi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
