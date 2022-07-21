<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishsListProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishs_list_product', function (Blueprint $table) {
            $table->unsignedBigInteger('wishs_list_id');
            $table->unsignedBigInteger('product_id');
            $table->primary(['wishs_list_id', 'product_id']);
            $table->foreign('wishs_list_id')->references('id')->on('wishs_lists')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('wishs_list_product');
    }
}
