<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_date',
        'order_reseller_id',
        'order_supplier_id',
        'order_product_id',
        'order_quantity',
        'order_price',
        'order_total',
        'order_payment',
        'order_status',
        'order_note',
        'order_rating',
        'order_review',
    ];

    public function reseller()
    {
        return $this->belongsTo(User::class, 'order_reseller_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'order_product_id');
    }
}

