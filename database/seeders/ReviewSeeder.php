<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
             'customer_id' => 1,
            'ulasan_rating' => 4.5,
            'ulasan_deskripsi' => 'Saya sangat senang mengunjungi Kafe Gama! Mereka memiliki suasana yang hangat dan ramah, Layanan mereka sangat baik dan stafnya sangat perhatian. Saya pasti akan kembali lagi!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
