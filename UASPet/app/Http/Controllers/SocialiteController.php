<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah terdaftar
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Buat user baru dari data Google
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(24)), // Generate random password
                    'email_verified_at' => now(), // Email dari Google sudah terverifikasi
                ]);

                // Tampilkan pesan sukses untuk user baru
                session()->flash('success', 'Akun berhasil dibuat dengan Google!');
            } else {
                // Update google_id jika belum ada
                if (empty($user->google_id)) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
                // Tampilkan pesan sukses login
                session()->flash('success', 'Berhasil login dengan Google!');
            }

            // Login user
            Auth::login($user, true);

            if($user->is_admin){
                return redirect()->route('admin.dashboard');
            }

            // Redirect ke halaman yang diinginkan
            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'error' => 'Login dengan Google gagal. Silakan coba lagi atau gunakan email dan password.',
                'google_error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
