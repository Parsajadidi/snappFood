<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\categorySeeder;
use Database\Seeders\discountSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            ['name' => "rasoul",
            'phone' => "09123",
            'role' => "admin",
            'email' => "rasoul@rasoul.com",
            'password' => Hash::make("123")],

            
            ['name' => "parsa jadidi",
            'phone' => "09198215096",
            'role' => "seller",
            'email' => "parsajad23@gmail.com",
            'password' => Hash::make("123")],
            ]);
            $this->call([categorySeeder::class,discountSeeder::class]);
    }
}
