<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleTargetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedule_target', function(Blueprint $table)
		{
			$table->integer('sch_target_id', true);
			$table->string('sch_target_your_manager')->nullable();
			$table->string('sch_target_user_id');
			$table->integer('sch_target_by')->nullable();
			$table->string('sch_target_date')->nullable();
			$table->string('sch_target_role')->nullable();
			$table->string('sch_target_business_category_id')->nullable();
			$table->string('sch_target_total_visits')->nullable();
			$table->string('sch_target_min_new_visits')->nullable();
			$table->timestamp('sch_target_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('sch_target_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('schedule_target');
	}

}
