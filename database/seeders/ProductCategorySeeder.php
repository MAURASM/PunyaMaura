<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $productCategories = ['Fashion', 'Kecantikan', 'Makanan', 'Hobi'];
        foreach ($productCategories as $category) {
            ProductCategory::create(['name' => $category]);
        }
    }
}
