<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_id');
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('to_id');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('created_at');
            $table->integer('updated_at');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('friends', function (Blueprint $table) {
            $table->dropForeign('friends_from_id_foreign');
            $table->dropForeign('friends_to_id_foreign');
        });
        Schema::dropIfExists('friends');
    }
}
