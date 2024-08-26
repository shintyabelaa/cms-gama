<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            ReviewSeeder::class,
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // // Create admins
        // User::insert([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'role' => 'super_admin',
        //     'password' => hash::make('password'), // default password
        // ]);
        // User::insert([
        //     'name' => 'bela',
        //     'email' => 'qwe@qwe.com',
        //     'role' => 'super_admin',
        //     'password' => hash::make('qwe'), // default password
        // ]);
        // User::insert([
        //     'name' => 'bela',
        //     'email' => 'qweqwe@qwe.com',
        //     'role' => 'admin', //non admin
        //     'password' => hash::make('qwe'), // default password
        // ]);

    }
}
