<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedule', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id');
			$table->string('date')->nullable();
			$table->integer('company_id')->nullable();
			$table->string('type_of_visit')->nullable();
			$table->text('sch_remarks', 65535)->nullable();
			$table->string('schedule_status')->nullable();
			$table->string('sch_reminder_reason')->nullable();
			$table->timestamps();
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
		Schema::drop('schedule');
	}

}
