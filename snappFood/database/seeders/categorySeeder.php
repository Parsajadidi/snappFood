<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeder for category ofFoods
        DB::table('categories')->insert(
            ['name' => 'pizza', 'type' => 'food'],
            ['name' => 'salad',  'type' => 'food'],
            ['name' => 'sandwich', 'type' => 'food'],
            ['name' => 'pasta', 'type' => 'food'],
            ['name' => 'kebab', 'type' => 'food'],
        );

        //seeder for category of Resturants
        DB::table('categories')->insert(
            ['name' => 'fastFood', 'type' => 'resturant'],
            ['name' => 'italian', 'type' => 'resturant'],
            ['name' => 'french', 'type' => 'resturant'],
            ['name' => 'iranian',  'type' => 'resturant']
        );
    }
}
