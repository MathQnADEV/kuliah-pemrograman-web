<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PetHotelBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PetHotelController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        // Query dasar
        $query = $user->petHotelBookings()->latest();

        // Filter berdasarkan status jika ada
        if (request()->has('status') && request()->status != '') {
            $query->where('status', request()->status);
        }

        $bookings = $query->paginate(9); // 9 item per halaman

        return view('user.pet-hotel.index', compact('bookings'));
    }

    public function create()
    {
        return view('user.pet-hotel.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:255',
            'pet_weight' => 'required|numeric|min:0.1|max:1000',
            'temprament' => 'required|string|max:255',
            'room_type' => 'required|string|in:standard,premium,luxury',
            'bring_own_food' => 'boolean',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'total_price' => 'required|numeric|min:0',
            'user_notes' => 'nullable|string',
        ]);
        $validator->validate();
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = User::findOrFail(Auth::id());

        if($user->petHotelBookings()->create($request->all())){
            return redirect()->route('user.pet-hotel.index')
                ->with('success', 'Pemesanan hotelan hewan berhasil!');
        }

        return redirect()->route('user.pet-hotel.index')
            ->with('error', 'Pemesanan hotelan hewan gagal!');
    }

    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $booking = $user->petHotelBookings()->findOrFail($id);

        // Hitung durasi jika belum ada
        if (!$booking->duration_days) {
            $booking->duration_days = \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out);
        }

        return view('user.pet-hotel.show', compact('booking'));
    }

    public function payment($id)
    {
        $user = User::findOrFail(Auth::id());
        $booking = $user->petHotelBookings()->findOrFail($id);

        // Validasi status pembayaran
        if ($booking->payment_status == 'paid') {
            return redirect()->route('user.pet-hotel.show', $id)
                ->with('info', 'Pembayaran sudah dilakukan sebelumnya.');
        }

        // Generate virtual account number (contoh)
        $virtualAccount = $this->generateVirtualAccount($booking);

        return view('user.payment', compact('booking', 'virtualAccount'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $user = User::findOrFail(Auth::id());
        $booking = $user->petHotelBookings()->findOrFail($id);

        // Validasi bahwa booking belum dibayar
        if ($booking->payment_status == 'paid') {
            return redirect()->route('user.pet-hotel.show', $id)
                ->with('error', 'Pembayaran sudah dilakukan sebelumnya.');
        }

        // Validasi input (jika ada upload bukti pembayaran)
        $validator = Validator::make($request->all(), [
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_method' => 'required|string|in:bank_transfer,qris,credit_card',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan bukti pembayaran jika ada
        $paymentData = [
            'payment_status' => 'paid',
            'paid_amount' => $booking->total_price,
            'payment_date' => now(),
            'payment_method' => $request->payment_method,
        ];

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment-proofs', 'public');
            $paymentData['payment_proof'] = $path;
        }

        // Update status pembayaran
        $booking->update($paymentData);

        return redirect()->route('user.pet-hotel.show', $id)
            ->with('success', 'Pembayaran berhasil dikonfirmasi! Status booking akan diperbarui setelah verifikasi admin.');
    }

    public function cancel(Request $request, $id)
    {
        $user = User::findOrFail(Auth::id());
        $booking = $user->petHotelBookings()->findOrFail($id);

        // Validasi bahwa booking bisa dibatalkan
        if (!in_array($booking->status, ['pending'])) {
            return redirect()->route('user.pet-hotel.show', $id)
                ->with('error', 'Booking tidak bisa dibatalkan karena status sudah ' . $booking->status);
        }

        // Update status menjadi cancelled
        $booking->update(['status' => 'cancelled']);

        return redirect()->route('user.pet-hotel.show', $id)
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    private function generateVirtualAccount($booking)
    {
        // Generate virtual account number (contoh: 888 + user_id + booking_id)
        $userId = str_pad($booking->user_id, 6, '0', STR_PAD_LEFT);
        $bookingId = str_pad($booking->id, 6, '0', STR_PAD_LEFT);
        return '888' . $userId . $bookingId;
    }
}
