<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRemarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remarks', function(Blueprint $table)
		{
			$table->integer('remarks_id', true);
			$table->string('remarks_user_id')->nullable();
			$table->string('remarks_for_id')->nullable();
			$table->string('remarks_schedule_id')->nullable();
			$table->string('remarks_funnel_id')->nullable();
			$table->string('remarks_purposal_id')->nullable();
			$table->string('remarks_order_id')->nullable();
			$table->string('remarks_detail')->nullable();
			$table->string('remarks_date')->nullable();
			$table->dateTime('remarks_created_at')->nullable();
			$table->dateTime('remarks_updated_at')->nullable();
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
		Schema::drop('remarks');
	}

}
