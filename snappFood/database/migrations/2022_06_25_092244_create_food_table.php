<?php

use App\Models\Category;
use App\Models\Discount;
use App\Models\Resturant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->mediumText('description');
            $table->boolean('is_foodParty')->default(false);
            $table->foreignIdFor(Discount::class)->nullable();
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Resturant::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
};
