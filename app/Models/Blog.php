<?php
// ═══════════════════════════════════════════
// FILE: app/Models/Blog.php
// ═══════════════════════════════════════════
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model {
    use HasFactory;
    protected $fillable = [
        'title','slug','excerpt','content','thumbnail','category',
        'author','is_published','is_featured','views','tags','meta_description'
    ];
    protected $casts = ['is_published'=>'boolean','is_featured'=>'boolean'];

    public function getRouteKeyName() { return 'slug'; }
    public function scopePublished($q) { return $q->where('is_published', true); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }
    public function scopeByCategory($q, $cat) { return $q->where('category', $cat); }
    public function incrementViews() { $this->increment('views'); }
}
