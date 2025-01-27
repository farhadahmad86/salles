<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductGroupTargetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_group_target', function(Blueprint $table)
		{
			$table->integer('product_group_target_id', true);
			$table->string('product_group_target_your_manager')->nullable();
			$table->string('product_group_target_user_id')->nullable();
			$table->integer('product_group_target_by')->nullable();
			$table->string('product_group_target')->nullable();
			$table->string('product_group_target_date')->nullable();
			$table->string('product_group_target_role')->nullable();
			$table->timestamp('product_group_target_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('product_group_target_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('product_group_target');
	}

}
