<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->date('start_day');
            $table->date('end_day');
            $table->date('image_url');
            $table->integer('cost'); //参考費用
            $table->boolean('is_opne'); //公開・非公開フラグ
            $table->integer('favorite_count')->default(0); //お気に入り数
            $table->integer('number_of_views')->default(0); //閲覧数
            $table->integer('referenced_number')->default(0); //参考数
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('plans');
    }
}