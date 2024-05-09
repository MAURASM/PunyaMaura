<?php

namespace Tests\Unit;

use App\Models\SupplierProduk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserType;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class SupplierProdukTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Reset the primary key
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_types AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_infos AUTO_INCREMENT = 1;');
    }

    public function tearDown(): void
    {
        // Reset the primary key
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_types AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_infos AUTO_INCREMENT = 1;');

        parent::tearDown();
    }

    public function testIndex()
    {
        // Membuat UserType
        UserType::insert([
            ['name' => 'Admin'],
            ['name' => 'Supplier'],
            ['name' => 'Reseller'],
        ]);

        UserInfo::insert([
            ['address' => 'Jl. Raya No. 2', 'phone' => '08123456789', 'bio' => 'Bio Supplier'],
        ]);

        // Membuat pengguna
        $user = User::factory()->create([
            'user_type_id' => 2,
            'user_info_id' => 1,
            'email' => 'supplier@gmail.com',
            'password' => '123456789',
        ]);

        // Melakukan permintaan login
        $response = $this->post(route('login'), [
            'email' => 'supplier@gmail.com',
            'password' => '123456789',
        ]);

        // Memastikan pengguna berhasil masuk
        $this->assertAuthenticatedAs($user);

        // Melakukan permintaan ke rute
        $response = $this->get(route('supplier.produk.index'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        // Melakukan permintaan login
        $response = $this->post(route('login'), [
            'email' => 'supplier@gmail.com',
            'password' => '123456789',
        ]);

        Storage::fake('public');

        $file = UploadedFile::fake()->image('product.jpg');

        $productCategories = ['Fashion', 'Kecantikan', 'Makanan', 'Hobi'];
        foreach ($productCategories as $category) {
            ProductCategory::create(['name' => $category]);
        }

        $response = $this->post(route('supplier.produk.store'), [
            'product_name' => 'Test Product',
            'description' => 'Test Description',
            'category_product_id' => 1,
            'quantity' => 10,
            'normal_price' => 100,
            'member_price' => 90,
            'photo' => $file,
        ]);

        $response->assertRedirect(route('supplier.produk.index'));
        $this->assertCount(1, SupplierProduk::all());
    }

    public function testUpdate()
    {
        // Melakukan permintaan login sebagai supplier
        $response = $this->post(route('login'), [
            'email' => 'supplier@gmail.com',
            'password' => '123456789',
        ]);

        // Simulasi penyimpanan file palsu
        Storage::fake('public');

        // Menyimpan data produk ke dalam tabel supplier_produks
        $products = [
            [
                'product_name' => 'Product 1',
                'quantity' => 100,
                'normal_price' => 100.00,
                'member_price' => 90.00,
                'description' => 'Description for product 1',
                'category_product_id' => 1,
                'photo' => 'product1.jpg'
            ]
        ];

        foreach ($products as $product) {
            SupplierProduk::create($product);
        }

        // Melakukan permintaan untuk memperbarui produk dengan ID 2
        $response = $this->put(route('supplier.produk.update', 2), [
            'product_name' => 'Product 1',
            'quantity' => 100,
            'normal_price' => 100.00,
            'member_price' => 90.00,
            'description' => 'Description for product 1',
            'category_product_id' => 1,
        ]);

        // Memastikan pengguna diarahkan kembali ke halaman index produk
        $response->assertRedirect(route('supplier.produk.index'));
    }


    // Metode pengujian untuk menguji penghapusan produk
    public function testDestroy()
    {
        // Melakukan permintaan login sebagai supplier
        $response = $this->post(route('login'), [
            'email' => 'supplier@gmail.com',
            'password' => '123456789',
        ]);

        // Data produk yang akan dihapus
        $products = [
            [
                'product_name' => 'Product 1',
                'quantity' => 100,
                'normal_price' => 100.00,
                'member_price' => 90.00,
                'description' => 'Description for product 1',
                'category_product_id' => 1,
                'photo' => 'product1.jpg'
            ]
        ];

        // Menyimpan data produk ke dalam tabel supplier_produks
        foreach ($products as $product) {
            SupplierProduk::create($product);
        }

        // Melakukan permintaan untuk menghapus produk dengan ID 3
        $response = $this->delete(route('supplier.produk.destroy', 3));

        // Memastikan pengguna diarahkan kembali ke halaman index produk
        $response->assertRedirect(route('supplier.produk.index'));
    }
}
