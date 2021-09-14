<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("名前");
            $table->string("category")->comment("レシピカテゴリ");
            $table->string("url")->comment("URL")->nullable();
            $table->text("memo")->comment("メモ")->nullable();
            $table->timestamps();
        });
        Schema::table('menu', function (Blueprint $table) {
            $table->unsignedBigInteger("recipe_id")->comment("レシピID")->after("timing")->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe');
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn("recipe_id");
        });
    }
}
