<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerarySpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_spots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cost'); //費用
            $table->unsignedBigInteger('itinerary_id');
            $table->unsignedBigInteger('spot_id');
            $table->timestamps();

            $table->foreign('itinerary_id')
                    ->references('id')
                    ->on('itineraries')
                    ->onDelete('cascade');
            
            $table->foreign('spot_id')
                    ->references('id')
                    ->on('spots')
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
        Schema::dropIfExists('itinerary_spots');
    }
}
