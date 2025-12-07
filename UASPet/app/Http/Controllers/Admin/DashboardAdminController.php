<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionPet;
use App\Models\PetHotelBooking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Stats
        $stats = [
            'total_bookings' => PetHotelBooking::count(),
            'pending_bookings' => PetHotelBooking::where('status', 'pending')->count(),
            'active_bookings' => PetHotelBooking::where('status', 'checked_in')->count(),
            'today_checkins' => PetHotelBooking::whereDate('check_in', today())->count(),
            'today_checkouts' => PetHotelBooking::whereDate('check_out', today())->count(),
            'total_users' => User::count(),
            'total_adoptions' => AdoptionPet::count(),
            'pending_adoptions' => AdoptionPet::where('status', 'pending')->count(),
            'reserved_adoptions' => AdoptionPet::where('status', 'reserved')->count(),
            'adopted_adoptions' => AdoptionPet::where('status', 'adopted')->count(),
            'available_adoptions' => AdoptionPet::where('status', 'available')->count(),
        ];

        // Adoption Stats
        $stats['total_adoptions'] > 0 ?
            $stats['pending_adoptions_percentage'] = $stats['pending_adoptions'] / $stats['total_adoptions'] * 100 :
            $stats['pending_adoptions_percentage'] = 0;

        $stats['total_adoptions'] > 0 ?
            $stats['reserved_adoptions_percentage'] = $stats['reserved_adoptions'] / $stats['total_adoptions'] * 100 :
            $stats['reserved_adoptions_percentage'] = 0;

        $stats['total_adoptions'] > 0 ?
            $stats['adopted_adoptions_percentage'] = $stats['adopted_adoptions'] / $stats['total_adoptions'] * 100 :
            $stats['adopted_adoptions_percentage'] = 0;

        $stats['total_adoptions'] > 0 ?
            $stats['available_adoptions_percentage'] = $stats['available_adoptions'] / $stats['total_adoptions'] * 100 :
            $stats['available_adoptions_percentage'] = 0;

        $recentBookings = PetHotelBooking::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', [
            'stats' => $stats,
            'recentBookings' => $recentBookings,
            'recentAdoptions' => $recentAdoptions ?? collect([]),
        ]);
    }
}
