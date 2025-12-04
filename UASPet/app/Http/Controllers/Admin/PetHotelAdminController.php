<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetHotelBooking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetHotelAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = PetHotelBooking::with('user')
            ->orderBy('created_at', direction: 'desc');

        // Filter status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter status pembayaran
        if ($request->has('payment_status') && $request->payment_status != 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter rentang tanggal
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('check_in', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('check_out', '<=', $request->date_to);
        }

        $bookings = $query->paginate(15);

        // Stats
        $stats = [
            'total' => PetHotelBooking::count(),
            'pending' => PetHotelBooking::where('status', 'pending')->count(),
            'confirmed' => PetHotelBooking::where('status', 'confirmed')->count(),
            'checked_in' => PetHotelBooking::where('status', 'checked_in')->count(),
            'checked_out' => PetHotelBooking::where('status', 'checked_out')->count(),
            'cancelled' => PetHotelBooking::where('status', 'cancelled')->count(),
        ];

        return view('admin.pet-hotel.index', compact('bookings', 'stats'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.pet-hotel.create', compact('users'));
    }

    public function show($id)
    {
        $booking = PetHotelBooking::with('user')->findOrFail($id);
        return view('admin.pet-hotel.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = PetHotelBooking::findOrFail($id);
        $users = User::orderBy('name')->get();
        return view('admin.pet-hotel.edit', compact('booking', 'users'));
    }

    public function update(Request $request, $id)
    {
        $booking = PetHotelBooking::findOrFail($id);
        $validated = $request->all([
            'user_id' => 'required|exists:users,id',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:255',
            'pet_weight' => 'required|numeric|min:0.1|max:1000',
            'temprament' => 'required|string|max:255',
            'room_type' => 'required|string|in:standard,premium,luxury',
            'bring_own_food' => 'boolean',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_price' => 'required|numeric|min:0',
            'payment_status' => 'required|in:unpaid,paid,partial',
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'admin_notes' => 'nullable|string|max:1000',
            'user_notes' => 'nullable|string|max:1000',
        ]);

        // Hitung durasi
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $duration = $checkIn->diffInDays($checkOut);

        $validated['duration_days'] = $duration;

        // Update payment_date jika berubah ke paid
        if ($request->payment_status == 'paid' && $booking->payment_status != 'paid') {
            $validated['payment_date'] = now();
            $validated['paid_amount'] = $request->total_price;
        }

        // Update payment_date jika berubah dari paid
        if ($request->payment_status != 'paid' && $booking->payment_status == 'paid') {
            $validated['payment_date'] = null;
            $validated['paid_amount'] = 0;
        }

        $booking->update($validated);

        return redirect()->route('admin.pet-hotel.show', $booking->id)
            ->with('success', 'Booking berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $booking = PetHotelBooking::findOrFail($id);

        if ($booking->payment_proof) {
            Storage::delete('public/' . $booking->payment_proof);
        }

        $booking->delete();

        return redirect()->route('admin.pet-hotel.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = PetHotelBooking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'status_label' => $booking->status,
            'status_class' => $this->getStatusClass($booking->status)
        ]);

    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $booking = PetHotelBooking::findOrFail($id);

        $request->validate([
            'payment_status' => 'required|in:unpaid,paid,partial',
            'paid_amount' => 'nullable|numeric|min:0|max:' . $booking->total_price,
        ]);

        $data = ['payment_status' => $request->payment_status];

        if ($request->has('paid_amount')) {
            $data['paid_amount'] = $request->paid_amount;
        }

        if ($request->payment_status == 'paid') {
            $data['payment_date'] = now();
            $data['paid_amount'] = $booking->total_price;
            $data['payment_method'] = $booking->payment_method;
            $data['payment_proof'] = $booking->payment_proof;
        }

        // Update payment_date jika berubah ke unpaid
        if ($request->payment_status == 'unpaid' && $booking->payment_status != 'unpaid') {
            $data['payment_date'] = null;
            $data['paid_amount'] = 0;
            $data['payment_proof'] = null;
            $data['payment_method'] = null;
            if ($booking->payment_proof) {
                Storage::delete('public/' . $booking->payment_proof);
            }
        }

        $booking->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Status pembayaran berhasil diperbarui',
            'payment_status_label' => $booking->payment_status_label,
            'payment_status_class' => $this->getPaymentStatusClass($booking->payment_status)
        ]);
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $booking = PetHotelBooking::findOrFail($id);

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_method' => 'required|string|max:255',
        ]);

        // Hapus bukti lama jika ada
        if ($booking->payment_proof) {
            Storage::delete('public/' . $booking->payment_proof);
        }

        // Simpan bukti baru
        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $booking->update([
            'payment_proof' => $path,
            'payment_method' => $request->payment_method,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti pembayaran berhasil diupload',
            'payment_proof_url' => asset('storage/' . $path)
        ]);
    }

    private function getStatusClass($status)
    {
        $classes = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'checked_in' => 'bg-green-100 text-green-800',
            'checked_out' => 'bg-gray-100 text-gray-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        return $classes[$status] ?? 'bg-gray-100 text-gray-800';
    }

    private function getPaymentStatusClass($paymentStatus)
    {
        $classes = [
            'unpaid' => 'bg-red-100 text-red-800',
            'partial' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
        ];

        return $classes[$paymentStatus] ?? 'bg-gray-100 text-gray-800';
    }
}
