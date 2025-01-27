<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderPurposalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_purposal', function(Blueprint $table)
		{
			$table->integer('order_purposal_id', true);
			$table->string('order_purposal_order_id');
			$table->string('order_purposal_user_id');
			$table->string('order_purposal_category_id')->nullable();
			$table->string('order_purposal_product_id');
			$table->string('order_purposal_qty');
			$table->string('order_purposal_sale');
			$table->string('order_purposal_total_amount');
			$table->text('order_purposal_pro_description', 65535);
			$table->string('order_purposal_payment_type');
			$table->string('order_purposal_date')->nullable();
			$table->timestamp('order_purposal_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('order_purposal_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('order_purposal');
	}

}
