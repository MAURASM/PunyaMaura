<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserType;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserType::create([
            'name' => 'Admin'
        ]);

        UserType::create([
            'name' => 'Reseller'
        ]);

        UserType::create([
            'name' => 'Supplier'
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'user_type_id' => 1
        ]);

        User::create([
            'name' => 'Supplier Dummy',
            'email' => 'supplier@gmail.com',
            'password' => bcrypt('password'),
            'user_type_id' => 3
        ]);

        /* User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'user_type_id' => 1
        ]); */

        User::factory(4)->create();

        ProductCategory::create([
            'name' => 'Fashion',
            'slug' => 'fashion'
        ]);

        ProductCategory::create([
            'name' => 'Kecantikan',
            'slug' => 'kecantikan'
        ]);

        ProductCategory::create([
            'name' => 'Makanan',
            'slug' => 'makanan'
        ]);

        ProductCategory::create([
            'name' => 'Mainan & Hobi',
            'slug' => 'mainan-hobi'
        ]);

        Product::create([
            'name' => 'Lego set',
            'slug' => 'lego-set',
            'user_id' => 2,
            'stock' => 10,
            'price' => 200000,
            'image'=>'https://source.unsplash.com/random',
            'product_category_id' => 4,
            'description' => 'Mainan anak-anak'
        ]);

        Product::create([
            'name' => 'Keripik singkong',
            'slug' => 'keripik-singkong',
            'user_id' => 2,
            'stock' => 12,
            'price' => 10000,
            'image'=>'https://source.unsplash.com/random',
            'product_category_id' => 3,
            'description' => 'Keripik singkong'
        ]);
    }
}
