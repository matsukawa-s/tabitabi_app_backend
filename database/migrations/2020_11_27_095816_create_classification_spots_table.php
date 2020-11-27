<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classification_spot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('classification_id');
            $table->unsignedBigInteger('spot_id');
            $table->timestamps();

            $table->foreign('classification_id')
                ->references('id')
                ->on('classifications')
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
        Schema::dropIfExists('classification_spots');
    }
}
