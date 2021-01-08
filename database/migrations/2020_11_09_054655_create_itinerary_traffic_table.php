<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryTrafficTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_traffic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('traffic_class'); //交通区分
            $table->string('travel_time'); //交通区分
            $table->integer('traffic_cost'); //交通区分
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
        Schema::dropIfExists('itinerary_traffic');
    }
}
