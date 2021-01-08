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
            $table->string('plan_code')->unique();
            $table->string('title');
            $table->string('description')->nullable();;
            $table->date('start_day');
            $table->date('end_day');
            $table->string('image_url');
            $table->integer('cost'); //参考費用
            $table->boolean('is_open'); //公開・非公開フラグ
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
