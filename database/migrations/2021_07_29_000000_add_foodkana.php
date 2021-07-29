<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFoodkana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food', function (Blueprint $table) {
            $table->string("kana")->comment("かな")->after("name");
            $table->unique("kana");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food', function (Blueprint $table) {
            $table->dropColumn("kana");
            $table->dropUnique("kana");
        });
    }
}
