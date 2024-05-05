<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserType;
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
    }
}
