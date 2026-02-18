<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category', 'icon', 'description', 'full_description',
        'thumbnail', 'gallery_images', 'location_name', 'latitude', 'longitude',
        'best_time_to_visit', 'is_featured', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
        'gallery_images' => 'array',
    ];

    public function getRouteKeyName() { return 'slug'; }
    public function scopeActive($q)   { return $q->where('is_active', true); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }
}
