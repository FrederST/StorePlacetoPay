<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
			$table->foreignId('user_id')->unsigned()->index('user_orders');
			$table->foreignId('product_id')->index('pruduct_order');
			$table->enum('status', array('CREATED','PAYED','REJECTED','PENDING'));
			$table->integer('requestId');
			$table->text('processUrl');
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
