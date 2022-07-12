<?php

namespace Database\Seeders;

use App\Models\Discount;
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
        Discount::create(
            ['discountPercent'=>0]
        );
        Discount::create(
            ['discountPercent'=>20]
        );
        Discount::create(
            ['discountPercent'=>25]
        );
        Discount::create(
            ['discountPercent'=>50]
        );
        Discount::create(
            ['discountPercent'=>33]
        );
        Discount::create(
            ['discountPercent'=>70]
        );
    }
}
