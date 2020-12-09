<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('place_id');
            $table->string('spot_name');
            $table->double('memory_latitube', 20, 14);
            $table->double('memory_longitube', 20, 14);
            $table->string('image_url');
            $table->unsignedBigInteger('prefecture_id');
            $table->timestamps();

            $table->foreign('prefecture_id')
                ->references('id')
                ->on('prefectures')
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
        Schema::dropIfExists('spots');
    }
}
