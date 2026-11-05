<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvInvestment extends Model
{
    use HasFactory;

    protected $table = 'ev_investments';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'national_id',
        'date_of_birth',
        'county',
        'occupation',
        'kra_pin',
        'referral_source',
        'bikes_count',
        'total_investment',
        'payment_method',
        'notes',
        'consent',
        'consent_at',
        'status',
        'stage',
        'admin_notes',
    ];

    protected $casts = [
        'date_of_birth'    => 'date',
        'consent'          => 'boolean',
        'consent_at'       => 'datetime',
        'total_investment' => 'decimal:2',
    ];
}
