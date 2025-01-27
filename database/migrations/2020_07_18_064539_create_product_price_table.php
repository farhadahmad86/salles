<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductPriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_price', function(Blueprint $table)
		{
			$table->integer('product_price_id', true);
			$table->integer('product_price_user_id')->nullable();
			$table->integer('product_price_product_id')->nullable();
			$table->string('product_price_purchase')->nullable();
			$table->string('product_price_sale')->nullable();
			$table->string('product_price_status')->nullable();
			$table->string('product_price_unit')->nullable();
			$table->dateTime('product_price_updated_at')->default('0000-00-00 00:00:00');
			$table->timestamp('product_price_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('os_name')->nullable();
			$table->string('browser')->nullable();
			$table->string('device')->nullable();
			$table->string('ip_address')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_price');
	}

}
