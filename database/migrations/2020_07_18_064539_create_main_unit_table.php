<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMainUnitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('main_unit', function(Blueprint $table)
		{
			$table->integer('main_unit_id', true);
			$table->integer('main_unit_user_id')->nullable();
			$table->string('main_unit_name')->nullable();
			$table->string('main_unit_remarks')->nullable();
			$table->timestamp('main_unit_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('main_unit_updated_at')->nullable()->default('0000-00-00 00:00:00');
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
		Schema::drop('main_unit');
	}

}
