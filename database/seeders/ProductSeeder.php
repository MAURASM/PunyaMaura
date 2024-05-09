<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'product_name' => 'Product A',
            'product_quantity' => 5,
            'product_normal_price' => 60000,
            'product_member_price' => 55000,
            'product_description' => 'Description of Product 1',
            'product_category_id' => 1,
            'product_supplier_id' => 2,
            'product_photo' => 'product1.jpg',
        ]);

        Product::create([
            'product_name' => 'Product B',
            'product_quantity' => 25,
            'product_normal_price' => 80000,
            'product_member_price' => 75000,
            'product_description' => 'Description of Product 2',
            'product_category_id' => 2,
            'product_supplier_id' => 2,
            'product_photo' => 'product2.jpg',
        ]);

        Product::create([
            'product_name' => 'Product C',
            'product_quantity' => 0,
            'product_normal_price' => 70000,
            'product_member_price' => 65000,
            'product_description' => 'Description of Product 3',
            'product_category_id' => 3,
            'product_supplier_id' => 2,
            'product_photo' => 'product3.jpg',
        ]);

        Product::create([
            'product_name' => 'Product D',
            'product_quantity' => 30,
            'product_normal_price' => 90000,
            'product_member_price' => 85000,
            'product_description' => 'Description of Product 4',
            'product_category_id' => 4,
            'product_supplier_id' => 2,
            'product_photo' => 'product4.jpg',
        ]);
    }
}
