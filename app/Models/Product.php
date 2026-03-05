<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price',
        'category_id', 'image', 'in_stock', 'featured', 'sort_order'
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'in_stock'   => 'boolean',
        'featured'   => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' Kč';
    }
}