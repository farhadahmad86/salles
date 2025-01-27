<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area', function(Blueprint $table)
		{
			$table->integer('area_id', true);
			$table->string('area_region_id')->nullable();
			$table->integer('area_user_id')->nullable();
			$table->string('area_name')->nullable();
			$table->string('area_remarks')->nullable();
			$table->timestamp('area_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('area_updated_at')->nullable()->default('0000-00-00 00:00:00');
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
		Schema::drop('area');
	}

}
