<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserType;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    // Metode setUp untuk dijalankan sebelum setiap pengujian
    public function setUp(): void
    {
        parent::setUp();

        // Reset auto increment primary key tabel
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_types AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_infos AUTO_INCREMENT = 1;');
    }

    // Metode tearDown untuk dijalankan setelah setiap pengujian
    public function tearDown(): void
    {
        // Reset auto increment primary key tabel
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_types AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE user_infos AUTO_INCREMENT = 1;');

        parent::tearDown();
    }

    // Pengujian untuk memperbarui profil supplier
    public function it_updates_a_supplier_profile()
    {
        // Membuat UserType
        UserType::insert([
            ['name' => 'Admin'],
            ['name' => 'Reseller'],
            ['name' => 'Supplier'],
        ]);

        // Menyimpan informasi tambahan pengguna (UserInfo) dan mendapatkan ID-nya
        $userInfo = UserInfo::insertGetId([
            'address' => 'Jl. Raya No. 2',
            'phone' => '08123456789',
            'bio' => 'Bio Supplier'
        ]);

        // Membuat pengguna baru dengan atribut tertentu
        $user = User::factory()->create([
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'user_type_id' => 3, // Asumsi 3 adalah ID jenis pengguna yang valid
            'user_info_id' => $userInfo,
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        // Membuat file avatar palsu untuk diunggah
        Storage::fake('public');
        $avatar = UploadedFile::fake()->image('avatar.jpg');

        // Data yang akan dikirim ke metode update
        $request = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'address' => 'Updated Address',
            'phone' => '1234567890',
            'bio' => 'Updated Bio',
            'avatar' => $avatar,
        ];

        // Melakukan permintaan ke metode update dengan mengirimkan data yang dibutuhkan
        $response = $this->put(route('supplier.update', $user->id), $request);

        // Memeriksa apakah data pengguna dan informasi pengguna telah diperbarui
        $user = db::table('users')->where('id', $user->id)->first();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
    }
}
