<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesPerson;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123')
        ]);

        for ($i = 1; $i <= 10; $i++) {
            SalesPerson::create([
                'nama' => 'Sales ' . $i,
                'no_hp' => '085123' . rand(10000, 99999),
                'alamat' => 'Alamat ' . $i,
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'nama' => 'Product ' . $i,
                'harga' => rand(10000, 99999),
                'deskripsi' => 'Deskripsi ' . $i,
            ]);
        }

        for ($i = 1; $i <= 2000000; $i++) {
            Sales::create([
                'products_id' => rand(1, 10),
                'sales_person_id' => rand(1, 10),
                'tanggal_transaksi' => date('Y-m-d', strtotime(rand(2000, 2024) . '-' . rand(1, 12) . '-' . rand(1, 30))),
                'sales_amount' => rand(100000, 9999999)
            ]);
        }
    }
}
