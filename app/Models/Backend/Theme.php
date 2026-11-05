<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme_name',
        'thumbnail',
        'is_active',
        'file_path',
        'primary_color',
        'text_color',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail) && file_exists(public_path($this->thumbnail))) {
            return static_asset($this->thumbnail);
        }

        return static_asset('images/default/blank-image.jpg');
    }

    public function getActiveStatusAttribute(): string
    {
        if ($this->is_active) {
            return '<span class="badge badge-success">'.__('levels.active').'</span>';
        }

        return '<span class="badge badge-danger">'.__('levels.inactive').'</span>';
    }
}
