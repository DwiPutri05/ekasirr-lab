<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Pulpen',
            'category' => 'ATK',
            'price' => 3000,
            'stock' => 100,
        ]);

        \App\Models\Product::create([
            'name' => 'Buku Tulis',
            'category' => 'ATK',
            'price' => 5000,
            'stock' => 50,
        ]);

        \App\Models\Product::create([
            'name' => 'Print Hitam Putih',
            'category' => 'CETAK',
            'price' => 500,
            'stock' => 999,
        ]);
    }
}
