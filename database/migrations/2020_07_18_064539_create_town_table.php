<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTownTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('town', function(Blueprint $table)
		{
			$table->integer('town_id', true);
			$table->integer('town_region_id')->nullable();
			$table->integer('town_area_id')->nullable();
			$table->integer('town_sector_id')->nullable();
			$table->integer('town_user_id')->nullable();
			$table->string('town_name')->nullable();
			$table->string('town_remarks')->nullable();
			$table->timestamp('town_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('town_updated_at')->nullable()->default('0000-00-00 00:00:00');
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
		Schema::drop('town');
	}

}
