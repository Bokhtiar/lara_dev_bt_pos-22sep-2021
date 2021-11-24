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
            $table->string('product_name');
            $table->string('product_sku')->nullable();
            $table->integer('alert_quantity')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('user_id');
            $table->integer('brand_id');
            $table->integer('warranty_id')->nullable();
            $table->string('unit_price');
            $table->string('unit_selling_price');
            $table->integer('unit_id');
            $table->string('product_image')->nullable();
            $table->longText('product_description')->nullable();

            //tin colurm
            $table->string('tin_unit')->nullable();
            $table->integer('variant_id')->nullable();
            $table->integer('unit_total_price')->nullable();
            $table->integer('unit_ban_price')->nullable();
            $table->integer('unit_per_pc_price')->nullable();
            $table->integer('unit_sell_total_price')->nullable();
            $table->integer('unit_sell_ban_price')->nullable();
            $table->integer('unit_sell_per_pc_price')->nullable();
            $table->tinyInteger('status')->default(0);
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
