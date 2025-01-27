<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('region', function(Blueprint $table)
		{
			$table->integer('region_id', true);
			$table->integer('reg_user_id')->nullable();
			$table->string('reg_name')->nullable();
			$table->string('reg_remarks')->nullable();
			$table->timestamp('reg_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('reg_updated_at')->nullable()->default('0000-00-00 00:00:00');
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
		Schema::drop('region');
	}

}
