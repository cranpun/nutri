<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodnutri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodnutri', function (Blueprint $table) {
            $table->id();
            $table->string("food_id")->comment("食材");
            $table->string("nutri_id")->comment("栄養素");
            $table->integer("amount")->comment("含有量：未使用")->default(0);
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
        Schema::dropIfExists('foodnutri');
    }
}
