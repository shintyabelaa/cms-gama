<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            'customer_nama' => 'Desak Made Shintya Belardin',
            'no_telepon' => '081297621446',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
