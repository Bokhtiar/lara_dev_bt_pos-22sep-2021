<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('invoice_no');
            $table->string('invoice_date');
            $table->longText('note')->nullable();
            $table->string('paid_amount');
            $table->string('total_amount');
            $table->string('sell_on_date');
            $table->string('due_paid_date')->nullable();
            $table->string('user_id');
            $table->string('payment_method');
            $table->string('bkash')->nullable();
            $table->string('nagud')->nullable();
            $table->string('rocket')->nullable();
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
        Schema::dropIfExists('sells');
    }
}
