<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_spots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('spot_id');
            $table->unsignedBigInteger('itinerary_spots_id');
            $table->timestamps();

            $table->foreign('spot_id')
                    ->references('id')
                    ->on('spots')
                    ->onDelete('cascade');
            $table->foreign('itinerary_spots_id')
                    ->references('id')
                    ->on('itinerary_spots')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_spots');
    }
}
