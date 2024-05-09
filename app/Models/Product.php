<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_quantity',
        'product_normal_price',
        'product_member_price',
        'product_description',
        'product_category_id',
        'product_supplier_id',
        'product_photo'
    ];

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
