<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'categories' => [
                [
                    'id' => 1,
                    'image' => 'assets/images/thumbnails/thumbnails-5.png',
                    'name' => 'Ayana Type Oleander',
                    'location' => 'Makassar',
                    'bedroom' => 2,
                    'bathroom' => 1,
                    'certificate' => 'SHGB',
                    'landarea' => '84 M²',
                ],
                [
                    'id' => 2,
                    'image' => 'assets/images/thumbnails/tanah-1.png',
                    'name' => 'Lahan Tahur Halang',
                    'location' => 'Bogor',
                    'bedroom' => null,
                    'bathroom' => null,
                    'certificate' => 'SHGB',
                    'landarea' => '1,1ha',
                ],
                [
                    'id' => 3,
                    'image' => 'assets/images/thumbnails/cozykost.png',
                    'name' => 'Investasi Kosan Villa',
                    'location' => 'Morowali',
                    'bedroom' => 2,
                    'bathroom' => 1,
                    'certificate' => 'SHGB',
                    'landarea' => '60 M²',
                ],
            ],
        ];
        return view('category.index', $data);
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
        if (!in_array($id, [1, 2, 3])) {
            return redirect()->route('category.index');
        }

        if ($id == 1) {
            $data = [
                'category' => [
                    'id' => 1,
                    'image1' => 'assets/images/thumbnails/thumbnails-5.png',
                    'image2' => 'assets/images/thumbnails/thumbnails-5.png',
                    'name' => 'Ayana Type Oleander',
                    'location' => 'Makassar',
                    'bedroom' => 2,
                    'bathroom' => 1,
                    'certificate' => 'SHGB',
                    'landArea' => '84 M²',
                    'landBuilding' => '75 M²',
                    'electricPower' => '-',
                    'description' => 'Hadiah Kanopi,
						Subsidi Biaya Kpr 25 jt*,
						Hadiah AC*,
						Tandon Air & Mesin Air.',
                    'locationMap' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127164.68765497561!2d119.34441769726561!3d-5.120378999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd8a3bc6fc21%3A0x322c74479421ee3!2sCluster%20Ayana!5e0!3m2!1sid!2sid!4v1759955128052!5m2!1sid!2sid',
                    'price' => '1.214.000.000'
                ],
            ];
        } elseif ($id == 2) {
            $data = [
                'category' => [
                    'id' => 2,
                    'image1' => 'assets/images/thumbnails/tanah-1.png',
                    'image2' => 'assets/images/thumbnails/tanah-2.png',
                    'name' => 'Lahan Tajur Halang',
                    'location' => 'Bogor',
                    'bedroom' => '-',
                    'bathroom' => '-',
                    'certificate' => 'SHGB',
                    'landArea' => '1,1ha',
                    'landBuilding' => '-',
                    'electricPower' => '-',
                    'description' => '1 pemilik, full SHM, dekat Samudra Residence akses jalan desa',
                    'locationMap' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31715.277094597037!2d106.76102005!3d-6.4696815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c283654f6c5b%3A0xfb8633b8315578da!2sKec.%20Tajur%20Halang%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1759955451030!5m2!1sid!2sid',
                    'price' => '8.250.000.000'
                ],
            ];
        } elseif ($id == 3) {
            $data = [
                'category' => [
                    'id' => 3,
                    'image1' => 'assets/images/thumbnails/cozykost.png',
                    'image2' => 'assets/images/thumbnails/cozykost.png',
                    'name' => 'Investasi Kosan Villa',
                    'location' => 'Morowali',
                    'bedroom' => 2,
                    'bathroom' => 1,
                    'certificate' => 'SHGB',
                    'landArea' => '60 M²',
                    'landBuilding' => '24 M²',
                    'electricPower' => '-',
                    'description' => 'Cozy Kost Morowali hadir dengan konsep hunian modern pertama di Morowali yang menawarkan kenyamanan lebih dan peluang investasi yang menjanjikan. Dengan harga terjangkau, Anda bisa memiliki unit kos dengan garansi income bulanan dan pengelolaan penuh oleh tim profesional kami. <br>
					- 🏡 Tipe Luna 24<br>
					- Investasi Aman<br>
					- Fully Furnished<br>
					- Fasilitas Lengkap<br>
					- Bergaransi Income 2 Tahun<br>
					Lokasi strategis dekat PT GNI Morowali, sangat cocok untuk para pekerja dan mahasiswa yang membutuhkan tempat tinggal praktis dan nyaman. Nikmati keuntungan jangka panjang, dikelola sepenuhnya oleh tim kami!<br><br>
					🚀 Segera miliki unit Anda dan dapatkan kesempatan berinvestasi dengan return yang menarik!<br>
					👉 DM untuk info lebih lanjut!<br>
					📞 Contact Us: +62 811-424-445 <br>
					#InvestasiProperti #PassiveIncome #CozyKostMorowali #InvestasiAman #PropertyInvestment #Morowali #FullyFurnished #BergaransiIncome',
                    'locationMap' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2041485.909272657!2d118.93851265625!3d-2.0450296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d8fe3000d0a383d%3A0x619f6c13a3af2997!2sCozy%20Kost!5e0!3m2!1sid!2sid!4v1759955992510!5m2!1sid!2sid',
                    'price' => '165.000.000',
                ]
            ];
        }
        return view('category.show', $data);
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
