<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit', function(Blueprint $table)
		{
			$table->integer('unit_id', true);
			$table->integer('unit_user_id')->nullable();
			$table->string('unit_main_unit_id')->nullable();
			$table->string('unit_name')->nullable();
			$table->string('unit_scale_size')->nullable();
			$table->string('unit_remarks')->nullable();
			$table->string('ip_address')->nullable();
			$table->string('os_name')->nullable();
			$table->string('browser')->nullable();
			$table->string('device')->nullable();
			$table->timestamp('unit_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('unit_updated_at')->nullable()->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('unit');
	}

}
