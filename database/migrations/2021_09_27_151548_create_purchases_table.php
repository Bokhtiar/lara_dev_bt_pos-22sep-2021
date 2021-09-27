<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('reference_no');
            $table->string('purchase_date');
            $table->string('attech_file')->nullable();
            $table->longText('note')->nullable();
            $table->integer('product_id');
            $table->string('purchase_quantity');
            $table->string('unit_cost_before_discount');
            $table->string('discount_percent')->nullable();
            $table->string('unit_cost_before_tax')->nullable();
            $table->string('tax')->nullable();
            $table->string('line_total');
            $table->string('profit_margin')->nullable();
            $table->string('unit_selling_price')->nullable();
            $table->string('amount');
            $table->string('paid_on_date');
            $table->string('payment_method');
            $table->string('bkash')->nullable();
            $table->string('rocket')->nullable();
            $table->string('nagud')->nullable();
            $table->string('bank')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}