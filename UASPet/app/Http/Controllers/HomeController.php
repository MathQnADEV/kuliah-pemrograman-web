<?php

namespace App\Http\Controllers;

use App\Models\AdoptionPet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('beranda.index');
    }

    public function petHotelPublic()
    {
        return view('layanan.petHotel');
    }

    public function adoptionPublic(Request $request)
    {
        $query = AdoptionPet::where('status', 'available');

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('breed', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Species filter
        if ($request->has('species') && $request->species != '') {
            $query->where('species', $request->species);
        }

        // Gender filter
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        // Age range filter
        if ($request->has('age_range') && $request->age_range != '') {
            $ageRange = $request->age_range;
            if ($ageRange == '0-1') {
                $query->where('age', '<=', 1);
            } elseif ($ageRange == '1-3') {
                $query->whereBetween('age', [1, 3]);
            } elseif ($ageRange == '3-7') {
                $query->whereBetween('age', [3, 7]);
            } elseif ($ageRange == '7+') {
                $query->where('age', '>', 7);
            }
        }

        $pets = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('layanan.adopt', compact('pets'));
    }

    public function notFound(){
        return view('not-found');
    }
}
