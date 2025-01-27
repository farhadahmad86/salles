<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunnelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funnel', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id');
			$table->string('date')->nullable();
			$table->integer('company_id')->nullable();
			$table->string('category_id', 191)->nullable();
			$table->string('mrc', 191)->nullable();
			$table->string('status_remarks')->nullable();
			$table->string('cat_remarks')->nullable();
			$table->string('status_id', 191)->nullable();
			$table->string('otc', 191)->nullable();
			$table->string('funnel_reminder_reason')->nullable();
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
		Schema::drop('funnel');
	}

}
