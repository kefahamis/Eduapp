<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('progressive_delivery')->default('No');
            $table->string('vip_support')->default('No');
            $table->string('page_abstract')->default('No');
            $table->string('essay_outline')->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
           $table->dropColumn('progressive_delivery');
           $table->dropColumn('vip_support');
           $table->dropColumn('page_abstract');
           $table->dropColumn('essay_outline');
       });
    }
}
