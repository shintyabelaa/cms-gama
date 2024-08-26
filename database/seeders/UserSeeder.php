<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Owner',
                'email' => 'owner@example.com',
                'password' => Hash::make('password'),
                'role' => 'owner',
            ],
            [
                'name' => 'Dapur',
                'email' => 'dapur@email.com',
                'role' => 'dapur',
                'password' => Hash::make('qwe'),
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@email.com',
                'role' => 'kasir',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
