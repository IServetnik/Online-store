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
            $table->float('rating', 2, 1)->default(0)->unsigned();
            $table->float('price', 12, 3)->unsigned();
            $table->float('old_price', 12, 3)->nullable()->unsigned();
            $table->string('category_name');
            $table->string('type_name');
            $table->string('brand');
            $table->string('color');
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
