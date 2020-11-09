<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // お気に入りのフォルダ用テーブル
        Schema::create('favorite_folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('folder_id');
            $table->unsignedBigInteger('spot_user_id');
            $table->timestamps();

            $table->foreign('folder_id')
                    ->references('id')
                    ->on('folders')
                    ->onDelete('cascade');
            $table->foreign('spot_user_id')
                    ->references('id')
                    ->on('spot_user')
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
        Schema::dropIfExists('favorite_folders');
    }
}
