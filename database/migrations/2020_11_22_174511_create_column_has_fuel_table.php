<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateColumnHasFuelTable extends Migration
{
    public function up()
    {
        Schema::create('column_has_fuel', function (Blueprint $table) {
            $table->unsignedBigInteger('fuel_id');
            $table->unsignedBigInteger('column_id');

            $table->foreign('fuel_id')
                ->references('id')
                ->on('fuels')
                ->onDelete('cascade');

            $table->foreign('column_id')
                ->references('id')
                ->on('columns')
                ->onDelete('cascade');

            $table->primary(['fuel_id', 'column_id'], 'column_has_fuels_fuel_id_column_id_primary');
        });
    }


    public function down()
    {
        Schema::dropIfExists('column_has_fuel');
    }
}
