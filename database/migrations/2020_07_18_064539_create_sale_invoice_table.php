<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaleInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sale_invoice', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id');
			$table->integer('inv_id');
			$table->string('category_id')->nullable();
			$table->string('product_id', 191)->nullable();
			$table->float('qty', 10, 0)->nullable();
			$table->float('sale', 10, 0)->nullable();
			$table->float('total_amount', 10, 0)->nullable();
			$table->string('payment_type');
			$table->string('date')->nullable();
			$table->timestamps();
			$table->string('ip_address')->nullable();
			$table->string('os_name')->nullable();
			$table->string('browser')->nullable();
			$table->string('device')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sale_invoice');
	}

}
