<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'product_gambar' => 'dark.jpg',
            'product_nama' => 'Miruku',
            'product_kategori' => 'Coffee',
            'product_harga' => 25000,
            'product_deskripsi' => 'Signature Kopi susu Gama Coffee House',
            'status_publish' => 'Y',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
