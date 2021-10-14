<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_code')->unique();
            $table->integer('customer_id');
            $table->string('paper_type');
            $table->string('subject');
            $table->text('topic')->nullable('Writer choice');
            $table->string('academic_level');
            $table->integer('pages');
            $table->string('service');
            $table->string('citation_style');
            $table->integer('no_of_citations');
            $table->longText('paper_instructions')->nullable();
            $table->string('writer_pick');
            $table->string('writer_quality')->nullable();
            $table->dateTime('deadline');
            $table->string('time_zone')->nullable();
            $table->integer('status')->default(0);
            $table->integer('assigned_to')->nullable();
            $table->text('dispute_reason')->nullable();
            $table->decimal('order_price',10,2)->default(0.00);
            $table->decimal('amount_paid',10,2)->default(0.00);
            $table->string('discount_code')->nullable();
            $table->decimal('dicount_amt',10,2)->default(0.00);
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
        Schema::dropIfExists('orders');
    }
}
