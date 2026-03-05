<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'url', 'type', 'category_id',
        'featured', 'sort_order', 'description'
    ];

    protected $casts = [
        'featured'   => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}