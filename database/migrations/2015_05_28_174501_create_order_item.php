<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->default(0);
			$table->foreign('product_id')->references('id')->on('products');
			$table->integer('order_id');
			$table->foreign('order_id')->references('id')->on('orders');
            $table->decimal('price', 8,2);
			$table->smallInteger('qtd');
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
		Schema::drop('order_items');
	}

}
