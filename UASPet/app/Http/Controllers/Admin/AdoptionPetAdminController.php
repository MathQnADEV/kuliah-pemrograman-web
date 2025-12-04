<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdoptionPetAdminController extends Controller
{
    public function index(Request $request)
    {
        // query
        $query = AdoptionPet::query();

        // Filter status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter ras
        if ($request->has('species') && $request->species != 'all') {
            $query->where('species', $request->species);
        }

        // Filter gender
        if ($request->has('gender') && $request->gender != 'all') {
            $query->where('gender', $request->gender);
        }

        // Pencarian nama
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('breed', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $pets = $query->orderBy('created_at', 'desc')->paginate(12);

        // Stats
        $stats = [
            'total' => AdoptionPet::count(),
            'available' => AdoptionPet::where('status', 'available')->count(),
            'reserved' => AdoptionPet::where('status', 'reserved')->count(),
            'adopted' => AdoptionPet::where('status', 'adopted')->count(),
            'pending' => AdoptionPet::where('status', 'pending')->count(),
        ];

        $speciesList = AdoptionPet::select('species')->distinct()->pluck('species');
        $pets->each(function ($pet) {
            $pet->images = $this->normalizeImages($pet->images);
        });

        return view('admin.adoption-pets.index', compact('pets', 'stats', 'speciesList'));
    }

    public function create()
    {
        return view('admin.adoption-pets.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:50',
            'breed' => 'nullable|string|max:100',
            'age' => 'required|decimal:0,2|min:0',
            'gender' => 'required|in:male,female',
            'weight' => 'nullable|numeric|min:0',
            'color' => 'nullable|string|max:100',
            'description' => 'required|string',
            'vaccinated' => 'boolean',
            'sterilized' => 'boolean',
            'dewormed' => 'boolean',
            'adoption_fee' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,reserved,adopted,pending',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'special_notes' => 'nullable|string',
            'entry_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // data validated
        $data = $validator->validated();

        // Handle checkbox fields
        $data['vaccinated'] = $request->has('vaccinated') ? 1 : 0;
        $data['sterilized'] = $request->has('sterilized') ? 1 : 0;
        $data['dewormed'] = $request->has('dewormed') ? 1 : 0;

        // Handle image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                // Generate unique filename
                $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('adoption-pets', $filename, 'public');
                $imagePaths[] = $path;
            }
            // JSON string
            $data['images'] = json_encode($imagePaths);
        } else {
            $data['images'] = null;
        }

        try {
            // Simpan data
            AdoptionPet::create($data);
            return redirect()->route('admin.adoption-pets.index')
                ->with('success', 'Hewan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $pet = AdoptionPet::findOrFail($id);

        $pet->images = $this->normalizeImages($pet->images);
        return view('admin.adoption-pets.show', compact('pet'));
    }

    public function edit($id)
    {
        $pet = AdoptionPet::findOrFail($id);

        $pet->images = $this->normalizeImages($pet->images);
        return view('admin.adoption-pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $pet = AdoptionPet::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'breed' => 'nullable|string|max:100',
            'age' => 'required|decimal:0,2|min:0',
            'gender' => 'required|in:male,female',
            'weight' => 'nullable|decimal:0,2|min:0',
            'color' => 'nullable|string|max:100',
            'description' => 'required|string',
            'vaccinated' => 'nullable|boolean',
            'sterilized' => 'nullable|boolean',
            'dewormed' => 'nullable|boolean',
            'adoption_fee' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,reserved,adopted,pending',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'special_notes' => 'nullable|string',
            'entry_date' => 'required|date',
            'images_to_remove' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Handle checkbox fields
        $data['vaccinated'] = $request->has('vaccinated') ? 1 : 0;
        $data['sterilized'] = $request->has('sterilized') ? 1 : 0;
        $data['dewormed'] = $request->has('dewormed') ? 1 : 0;

        $existingImages = $pet->images ?? [];
        if (!empty($data['images_to_remove'])) {
            try {
                $imagesToRemove = json_decode($data['images_to_remove'], true);

                if (is_array($imagesToRemove) && !empty($imagesToRemove)) {
                    foreach ($imagesToRemove as $imageToRemove) {
                        // Hapus dari storage
                        if (Storage::disk('public')->exists($imageToRemove)) {
                            Storage::disk('public')->delete($imageToRemove);
                        }

                        // Hapus dari array existing images
                        $key = array_search($imageToRemove, $existingImages);
                        if ($key !== false) {
                            unset($existingImages[$key]);
                        }
                    }

                    // Re-index array
                    $existingImages = array_values($existingImages);
                }
            } catch (\Exception $e) {
                Log::error('Error removing images: ' . $e->getMessage());
            }
            unset($data['images_to_remove']);
        }
        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('adoption-pets', $filename, 'public');
                $newImagePaths[] = $path;
            }
        }

        // Gabungkan gambar lama
        if (!is_array($existingImages)) {
            $existingImages = $this->normalizeImages($existingImages);
        }

        // Gabungkan array
        $allImages = array_merge($existingImages, $newImagePaths);

        // Simpan sebagai JSON
        $data['images'] = !empty($allImages) ? json_encode($allImages) : null;

        try {
            $pet->update($data);

            return redirect()->route('admin.adoption-pets.show', $pet->id)
                ->with('success', 'Data hewan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Update adoption pet error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $pet = AdoptionPet::findOrFail($id);

        try {
            // Hapus gambar jika ada
            if ($pet->images) {
                $images = $this->normalizeImages($pet->images);
                foreach ($images as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $pet->delete();

            return redirect()->route('admin.adoption-pets.index')
                ->with('success', 'Hewan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $pet = AdoptionPet::findOrFail($id);

        $request->validate([
            'status' => 'required|in:available,reserved,adopted,pending',
        ]);

        $pet->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
        ]);
    }
    public function removeImage(Request $request, $id)
    {
        $pet = AdoptionPet::findOrFail($id);

        $request->validate([
            'image_path' => 'required|string'
        ]);

        $imagePath = $request->image_path;

        try {
            // Decode images dari database
            $images = $pet->images;

            if (empty($images)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada gambar untuk dihapus'
                ], 404);
            }

            if (!is_array($images)) {
                $images = json_decode($images, true) ?? [];
            }

            $key = array_search($imagePath, $images);

            if ($key === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gambar tidak ditemukan'
                ], 404);
            }

            // Hapus file dari storage
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Hapus dari array
            unset($images[$key]);

            // Re-index array
            $images = array_values($images);

            // Update database
            $pet->update(['images' => !empty($images) ? json_encode($images) : null]);

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil dihapus',
                'remaining_images' => $images
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // normalisasi images dari json string ke array
    private function normalizeImages($images)
    {
        if (empty($images)) {
            return [];
        }

        if (is_array($images)) {
            return $images;
        }

        if (is_string($images)) {
            $decoded = json_decode($images, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }
}
