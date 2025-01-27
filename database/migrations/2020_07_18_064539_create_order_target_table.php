<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderTargetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_target', function(Blueprint $table)
		{
			$table->integer('order_target_id', true);
			$table->string('order_target_your_manager')->nullable();
			$table->string('order_target_user_id')->nullable();
			$table->integer('order_target_by')->nullable();
			$table->string('order_target_product_category')->nullable();
			$table->string('order_target_date')->nullable();
			$table->string('order_target_role')->nullable();
			$table->string('order_target_otc')->nullable();
			$table->string('order_target_mrc')->nullable();
			$table->timestamp('order_target_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('order_target_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('order_target');
	}

}
