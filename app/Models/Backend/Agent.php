<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agents';

    protected $fillable = [
        'name',
        'business_name',
        'email',
        'phone',
        'type',
        'county',
        'address',
        'volume',
        'notes',
        'status',
    ];

    /**
     * Human label for the application type.
     */
    public function getTypeLabelAttribute(): string
    {
        return [
            'agent'  => 'Agent',
            'seller' => 'Online seller',
            'shop'   => 'Existing shop',
        ][$this->type] ?? ucfirst((string) $this->type);
    }
}
