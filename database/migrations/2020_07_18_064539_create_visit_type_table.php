<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visit_type', function(Blueprint $table)
		{
			$table->integer('visit_type_id', true);
			$table->string('visit_type_name');
			$table->string('visit_type_user_id');
			$table->timestamp('visit_type_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('visit_type_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('visit_type');
	}

}
