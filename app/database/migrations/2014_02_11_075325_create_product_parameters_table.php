<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductParametersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_parameters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('parameter_id');
			$table->unsignedInteger('product_id');
			$table->string('value');
			$table->integer('order')->index();

			$table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_parameters');
	}

}