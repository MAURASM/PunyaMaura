<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Entry 1
        $order1 = new Order();
        $order1->order_number = '0001';
        $order1->order_date = '2024-05-01'; // Sesuaikan dengan tanggal yang diinginkan
        $order1->order_reseller_id = 3;
        $order1->order_supplier_id = 2;
        $order1->order_product_id = 1; // Sesuaikan dengan ID produk yang diinginkan
        $order1->order_quantity = 5; // Sesuaikan dengan kuantitas yang diinginkan
        $order1->order_price = 10000; // Sesuaikan dengan harga yang diinginkan
        $order1->order_total = $order1->order_quantity * $order1->order_price;
        $order1->order_payment = 'Sukses';
        $order1->order_status = 'Selesai';
        $order1->order_note = 'Tidak ada catatan';
        $order1->order_rating = 4;
        $order1->order_review = 'Barangnya bagus, pengiriman cepat';
        $order1->save();

        // Entry 2
        $order2 = new Order();
        $order2->order_number = '0002';
        $order2->order_date = '2024-05-02'; // Sesuaikan dengan tanggal yang diinginkan
        $order2->order_reseller_id = 3;
        $order2->order_supplier_id = 2;
        $order2->order_product_id = 2; // Sesuaikan dengan ID produk yang diinginkan
        $order2->order_quantity = 10; // Sesuaikan dengan kuantitas yang diinginkan
        $order2->order_price = 15000; // Sesuaikan dengan harga yang diinginkan
        $order2->order_total = $order2->order_quantity * $order2->order_price;
        $order2->order_payment = 'Pending';
        $order2->order_status = '-';
        $order2->save();

        // Entry 3
        $order3 = new Order();
        $order3->order_number = '0003';
        $order3->order_date = '2024-05-03'; // Sesuaikan dengan tanggal yang diinginkan
        $order3->order_reseller_id = 3;
        $order3->order_supplier_id = 2;
        $order3->order_product_id = 3; // Sesuaikan dengan ID produk yang diinginkan
        $order3->order_quantity = 8; // Sesuaikan dengan kuantitas yang diinginkan
        $order3->order_price = 20000; // Sesuaikan dengan harga yang diinginkan
        $order3->order_total = $order3->order_quantity * $order3->order_price;
        $order3->order_payment = 'Sukses';
        $order3->order_status = 'Diproses';
        $order3->save();

        // Entry 4
        $order4 = new Order();
        $order4->order_number = '0004';
        $order4->order_date = '2024-05-04'; // Sesuaikan dengan tanggal yang diinginkan
        $order4->order_reseller_id = 3;
        $order4->order_supplier_id = 2;
        $order4->order_product_id = 4; // Sesuaikan dengan ID produk yang diinginkan
        $order4->order_quantity = 3; // Sesuaikan dengan kuantitas yang diinginkan
        $order4->order_price = 12000; // Sesuaikan dengan harga yang diinginkan
        $order4->order_total = $order4->order_quantity * $order4->order_price;
        $order4->order_payment = 'Sukses';
        $order4->order_status = 'Proses Pengiriman';
        $order4->save();

        // Entry 5
        $order5 = new Order();
        $order5->order_number = '0005';
        $order5->order_date = '2024-05-05'; // Sesuaikan dengan tanggal yang diinginkan
        $order5->order_reseller_id = 3;
        $order5->order_supplier_id = 2;
        $order5->order_product_id = 1; // Sesuaikan dengan ID produk yang diinginkan
        $order5->order_quantity = 6; // Sesuaikan dengan kuantitas yang diinginkan
        $order5->order_price = 18000; // Sesuaikan dengan harga yang diinginkan
        $order5->order_total = $order5->order_quantity * $order5->order_price;
        $order5->order_payment = 'Sukses';
        $order5->order_status = 'Ditolak';
        $order5->save();
    }
}
