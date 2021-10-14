<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->integer('user_id');
           $table->string('transaction_id');
           $table->string('order_id')->nullable();
           $table->string('transaction_type')->default('Order payment');
           $table->decimal('amount',30,2)->default(0.00);
           $table->string('status');
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
        Schema::dropIfExists('transactions');
    }
}
