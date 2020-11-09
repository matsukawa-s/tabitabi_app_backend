<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('memo');
            $table->unsignedBigInteger('itinerary_id');
            $table->timestamps();

            $table->foreign('itinerary_id')
                    ->references('id')
                    ->on('itineraries')
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
        Schema::dropIfExists('itinerary_notes');
    }
}
