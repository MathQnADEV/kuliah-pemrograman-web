<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Show user profile page
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $userData = User::find($user->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20|regex:/^08[0-9]{8,11}$/',
            'date_of_birth' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:500',
        ], [
            'phone.regex' => 'Format nomor telepon tidak valid. Gunakan format 08xxxxxxxxxx',
            'date_of_birth.before' => 'Tanggal lahir tidak boleh lebih dari hari ini',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.profile')
                ->withErrors($validator)
                ->withInput();
        }

        // Update user data
        $userData->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        // Only allow password change for non-google accounts
        if (Auth::user()->google_id) {
            return redirect()->route('user.profile')
                ->withErrors(['error' => 'Akun Google tidak dapat mengubah password melalui aplikasi.'])
                ->withInput();
        }

        $user = Auth::user();
        $userData = User::find($user->id);

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('user.profile')
                ->withErrors(['current_password' => 'Password saat ini salah.'])
                ->withInput();
        }

        if ($validator->fails()) {
            return redirect()->route('user.profile')
                ->withErrors($validator)
                ->withInput();
        }

        // Update password
        $userData->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('user.profile')->with('success', 'Password berhasil diubah!');
    }

    /**
     * Delete user account
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $userData = User::find($user->id);

        // Logout user
        Auth::logout();

        // Delete user account
        $userData->delete();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun Anda berhasil dihapus. Terima kasih telah menggunakan layanan kami!');
    }
}
