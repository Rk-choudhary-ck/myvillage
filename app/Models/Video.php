<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'video_type', 'video_url', 'video_path',
        'thumbnail', 'category', 'duration', 'is_featured', 'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function scopeActive($q)   { return $q->where('is_active', true); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }

    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) return null;
        if (str_contains($this->video_url, 'youtube.com') || str_contains($this->video_url, 'youtu.be')) {
            preg_match('/(?:v=|youtu\.be\/)([^&\s]+)/', $this->video_url, $m);
            return isset($m[1]) ? "https://www.youtube.com/embed/{$m[1]}" : $this->video_url;
        }
        return $this->video_url;
    }
}
