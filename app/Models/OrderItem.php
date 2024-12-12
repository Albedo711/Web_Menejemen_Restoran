<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
        'subtotal',
    ];

    /**
     * Relation to Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relation to Menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}