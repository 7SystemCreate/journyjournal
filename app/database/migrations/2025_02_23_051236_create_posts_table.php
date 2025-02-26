<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title' ,'255');
            $table->date('date');
            $table->integer('max_people');
            $table->string('comment' ,'255');
            $table->string('image' ,'255')->nullable();
            $table->integer('amount');
            $table->integer('user_id');
            $table->tinyInteger('booking_flg')->default(0);
            $table->tinyInteger('del_flg')->default(0);
            $table->tinyInteger('report_flg')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
