<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataCategories = [
            'categories' =>[
                [
                    'thumbnail' => asset('assets/images/thumbnails/thumbnails-1.png'),
                    'name' => 'Pesisir Pantai',
                    'house' => '0',
                ],
                [
                    'thumbnail' => asset('assets/images/thumbnails/thumbnails-2.png'),
                    'name' => 'Bukit',
                    'house' => '0',
                ],
                [
                    'thumbnail' => asset('assets/images/thumbnails/thumbnails-3.png'),
                    'name' => 'Desa',
                    'house' => '1',
                ],
                [
                    'thumbnail' => asset('assets/images/thumbnails/thumbnails-4.png'),
                    'name' => 'Perumahan',
                    'house' => '1',
                ],
                [
                    'thumbnail' => asset('assets/images/thumbnails/thumbnails-2.png'),
                    'name' => 'Villa',
                    'house' => '1',
                ],
            ]
        ];

        $dataTestimonials = [
            'testimonials' =>[
                [
                    'name' => 'Sarina Dwi',
                    'job' => 'House Designer',
                    'photoProfile' => asset('assets/images/photos/profile.png'),
                    'phone' => '081234567890',
                    'stars' => 5,
                    'message' => 'Awalnya takut dibawa kabur duitnya lalu dolor dicoba kok malah amet lorem dolor si happines puas pokoknya mas',
                ],
                [
                    'name' => 'Sarina Dwi',
                    'job' => 'House Designer',
                    'photoProfile' => asset('assets/images/photos/profile.png'),
                    'phone' => '081234567890',
                    'stars' => 5,
                    'message' => 'Beneran membantu banget tanpa basa basi KPR langsung beres',
                ],
                [
                    'name' => 'Sarina Dwi',
                    'job' => 'House Designer',
                    'photoProfile' => asset('assets/images/photos/profile-2.png'),
                    'phone' => '081234567890',
                    'stars' => 5,
                    'message' => 'Beneran membantu banget tanpa basa basi KPR langsung beres',
                ],
                [
                    'name' => 'Sarina Dwi',
                    'job' => 'House Designer',
                    'photoProfile' => asset('assets/images/photos/profile-3.png'),
                    'phone' => '081234567890',
                    'stars' => 5,
                    'message' => 'Awalnya takut dibawa kabur duitnya lalu dolor dicoba kok malah amet lorem dolor si happines puas pokoknya mas',
                ],
                [
                    'name' => 'Sarina Dwi',
                    'job' => 'House Designer',
                    'photoProfile' => asset('assets/images/photos/profile-4.png'),
                    'phone' => '081234567890',
                    'stars' => 5,
                    'message' => 'Awalnya takut dibawa kabur duitnya lalu dolor dicoba kok malah amet lorem dolor si happines puas pokoknya mas',
                ],
            ]
        ];
        return view('index', $dataCategories, $dataTestimonials);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
