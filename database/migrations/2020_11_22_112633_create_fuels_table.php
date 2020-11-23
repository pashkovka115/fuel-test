<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateFuelsTable extends Migration
{
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->string('fuel');
            $table->string('code')->unique();
            $table->unsignedInteger('volume');
            $table->unsignedDecimal('price', 10, 2);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('fuels');
    }
}
