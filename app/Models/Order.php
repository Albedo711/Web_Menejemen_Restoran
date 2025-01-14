<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'total_price',
        'order_date',
    ];

    /**
     * Relation to OrderItems.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
