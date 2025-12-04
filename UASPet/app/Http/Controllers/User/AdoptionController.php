<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index()
    {
        // Ambil semua aplikasi adopsi milik user yang login
        $applications = []; // Ganti dengan query ke model

        return view('user.adoption.index', compact('applications'));
    }

    public function create()
    {
        return view('user.adoption.create');
    }

    public function store(Request $request)
    {
        // Simpan aplikasi adopsi baru
        // Validasi dan simpan ke database

        return redirect()->route('user.adoption.index')->with('success', 'Aplikasi adopsi berhasil dibuat!');
    }

    public function show($id)
    {
        // Tampilkan detail aplikasi adopsi
        $application = []; // Ganti dengan query ke model

        return view('user.adoption.show', compact('application'));
    }

    public function tracking($id)
    {
        // Tampilkan tracking status aplikasi adopsi
        $application = []; // Ganti dengan query ke model

        return view('user.adoption.tracking', compact('application'));
    }
}
