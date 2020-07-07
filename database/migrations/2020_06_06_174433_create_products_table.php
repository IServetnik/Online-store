<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('name')->unique();
            $table->float('rating', 2, 1)->nullable();
            $table->float('price', 12, 3);
            $table->float('old_price', 12, 3)->nullable();
            $table->string('category_name');
            $table->foreign('category_name')->references('name')->on('categories')->onDelete('cascade');
            $table->string('type_name');
            $table->foreign('type_name')->references('name')->on('types')->onDelete('cascade');
            $table->string('brand');
            $table->string('color');
            $table->text('sizes');
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
        Schema::dropIfExists('products');
    }
}
