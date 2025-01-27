<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermAndConditionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('term_and_condition', function(Blueprint $table)
		{
			$table->integer('tandc_id', true);
			$table->string('tandc_title');
			$table->text('tandc_description', 65535);
			$table->timestamp('tandc_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('tandc_updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('ip_address')->nullable();
			$table->string('os_name')->nullable();
			$table->string('browser')->nullable();
			$table->string('device')->nullable();
			$table->string('tandc_user_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('term_and_condition');
	}

}
