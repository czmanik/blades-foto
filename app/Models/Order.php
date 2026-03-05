<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'first_name', 'last_name', 'email', 'phone',
        'address', 'city', 'zip', 'note', 'total', 'status'
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new'        => 'Nová',
            'processing' => 'Zpracovává se',
            'shipped'    => 'Odesláno',
            'completed'  => 'Dokončeno',
            'cancelled'  => 'Zrušeno',
            default      => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new'        => 'blue',
            'processing' => 'yellow',
            'shipped'    => 'purple',
            'completed'  => 'green',
            'cancelled'  => 'red',
            default      => 'gray',
        };
    }
}