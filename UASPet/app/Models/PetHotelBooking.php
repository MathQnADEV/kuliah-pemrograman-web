<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetHotelBooking extends Model
{
    protected $table = 'pet_hotel_bookings';

    protected $fillable = [
        'user_id',
        'owner_name',
        'owner_phone',
        'pet_name',
        'pet_type',
        'pet_weight',
        'temprament',
        'room_type',
        'bring_own_food',
        'check_in',
        'check_out',
        'total_price',
        'payment_status',
        'payment_method',
        'payment_proof',
        'paid_amount',
        'payment_date',
        'status',
        'admin_notes',
        'user_notes',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
