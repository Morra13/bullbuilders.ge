<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharityCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_comment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('charity_id');
            $table->string('main_img')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->longText('comment');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charity_comment');
    }
}
