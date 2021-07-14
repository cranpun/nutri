<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutri', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("名前");
            $table->integer("dailyrequired")->comment("1日の必須量：未使用")->default(0);
            $table->integer("pos")->comment("表示位置。昇順。");
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
        Schema::dropIfExists('nutri');
    }
}
