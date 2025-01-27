<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_group', function(Blueprint $table)
		{
			$table->integer('product_group_id', true);
			$table->integer('product_group_user_id')->nullable();
			$table->string('product_group_name')->nullable();
			$table->string('product_group_remarks')->nullable();
			$table->string('ip_address')->nullable();
			$table->string('os_name')->nullable();
			$table->string('browser')->nullable();
			$table->string('device')->nullable();
			$table->timestamp('product_group_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('product_group_updated_at')->nullable()->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_group');
	}

}
