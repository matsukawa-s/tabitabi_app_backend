<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('review_id');
            $table->string('photo_url');
            $table->timestamps();

            $table->foreign('review_id')
                    ->references('id')
                    ->on('reviews')
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
        Schema::dropIfExists('open_photos');
    }
}
