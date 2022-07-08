<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class discountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert(
            ['discountPercent'=>0],
            ['discountPercent'=>20],
            ['discountPercent'=>25],
            ['discountPercent'=>50],
            ['discountPercent'=>33],
            ['discountPercent'=>70],
        );
    }
}
