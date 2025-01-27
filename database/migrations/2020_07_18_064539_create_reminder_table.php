<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReminderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reminder', function(Blueprint $table)
		{
			$table->integer('reminder_id', true);
			$table->string('reminder_user_id')->nullable();
			$table->string('reminder_for_id')->nullable();
			$table->string('reminder_schedule_id')->nullable();
			$table->string('reminder_funnel_id')->nullable();
			$table->string('reminder_purposal_id')->nullable();
			$table->string('reminder_order_id')->nullable();
			$table->string('reminder_remarks')->nullable();
			$table->string('reminder_date')->nullable();
			$table->string('reminder_reason')->nullable();
			$table->dateTime('reminder_created_at')->nullable();
			$table->dateTime('reminder_updated_at')->nullable();
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
		Schema::drop('reminder');
	}

}
