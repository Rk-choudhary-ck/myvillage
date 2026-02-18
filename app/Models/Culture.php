<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Culture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'icon', 'category', 'description', 'full_description',
        'thumbnail', 'is_active', 'sort_order'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q) { return $q->where('is_active', true); }
}
