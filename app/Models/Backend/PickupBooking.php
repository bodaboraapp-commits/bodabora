<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PickupBooking extends Model
{
    protected $table = 'pickup_bookings';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'pickup_address',
        'dropoff_address',
        'receiver_name',
        'receiver_phone',
        'parcel_description',
        'parcel_quantity',
        'weight',
        'preferred_date',
        'preferred_time',
        'notes',
        'status',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];
}
