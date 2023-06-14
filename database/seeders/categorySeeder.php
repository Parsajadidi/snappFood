<?php

namespace Database\Seeders;

use App\Models\Category;
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
        Category::create(['name' => 'pizza', 'type' => 'food']);
        Category::create(['name' => 'salad',  'type' => 'food']);
        Category::create(['name' => 'sandwich', 'type' => 'food']);
        Category::create( ['name' => 'pasta', 'type' => 'food']);
        Category::create( ['name' => 'kebab', 'type' => 'food']);


        //seeder for category of Resturants
        Category::create(['name' => 'fastFood', 'type' => 'resturant']);
        Category::create(['name' => 'italian', 'type' => 'resturant']);
        Category::create(['name' => 'french', 'type' => 'resturant']);
        Category::create(['name' => 'iranian',  'type' => 'resturant']);
    }
}
