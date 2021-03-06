<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->integer('category_id')->unsigned()->default(0);
			$table->foreign('category_id')->references('id')->on('categories');
		});
	}

	
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->removeColumn('category_id');
		});
	}

}
