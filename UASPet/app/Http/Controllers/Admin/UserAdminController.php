<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id()) // Exclude current admin
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent deleting yourself
            if ($user->id === Auth::id()) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Anda tidak dapat menghapus akun sendiri!');
            }

            // Prevent deleting other admins
            if ($user->is_admin) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Tidak dapat menghapus administrator lain!');
            }

            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'Pengguna berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
