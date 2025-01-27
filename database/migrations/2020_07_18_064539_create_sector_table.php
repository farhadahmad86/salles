<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sector', function(Blueprint $table)
		{
			$table->integer('sector_id', true);
			$table->integer('sec_region_id')->nullable();
			$table->integer('sec_area_id')->nullable();
			$table->integer('sec_user_id')->nullable();
			$table->string('sec_name')->nullable();
			$table->string('sec_remarks')->nullable();
			$table->timestamp('sec_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('sec_updated_at')->nullable()->default('0000-00-00 00:00:00');
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
		Schema::drop('sector');
	}

}
