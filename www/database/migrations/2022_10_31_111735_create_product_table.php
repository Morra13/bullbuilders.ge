<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('nameGe');
            $table->string('nameRu')->nullable();
            $table->string('nameEng')->nullable();
            $table->string('main_img')->nullable();
            $table->string('more_img_0')->nullable();
            $table->string('more_img_1')->nullable();
            $table->string('more_img_2')->nullable();
            $table->string('descriptionGe');
            $table->string('descriptionRu')->nullable();
            $table->string('descriptionEng')->nullable();
            $table->integer('category_id');
            $table->float('weight');
            $table->float('qty');
            $table->float('price');
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
        Schema::dropIfExists('product');
    }
}
