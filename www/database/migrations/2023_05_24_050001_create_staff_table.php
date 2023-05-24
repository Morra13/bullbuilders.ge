<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('photo')->nullable();
            $table->string('name_ge');
            $table->string('surname_ge');
            $table->string('position_ge');
            $table->string('comment_ge');
            $table->string('name_ru')->nullable();
            $table->string('surname_ru')->nullable();
            $table->string('position_ru')->nullable();
            $table->string('comment_ru')->nullable();
            $table->string('name_en')->nullable();
            $table->string('surname_en')->nullable();
            $table->string('position_en')->nullable();
            $table->string('comment_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
