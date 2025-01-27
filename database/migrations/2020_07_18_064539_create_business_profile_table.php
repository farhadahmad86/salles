<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_profile', function(Blueprint $table)
		{
			$table->integer('business_profile_id', true);
			$table->string('business_profile_logo')->nullable();
			$table->string('business_profile_name')->nullable();
			$table->string('business_profile_address')->nullable();
			$table->string('business_profile_ntn_no')->nullable();
			$table->string('business_profile_gst_no')->nullable();
			$table->string('business_profile_mobile_no')->nullable();
			$table->string('business_profile_ptcl_no')->nullable();
			$table->string('business_profile_email')->nullable();
			$table->string('business_profile_web_address')->nullable();
			$table->timestamp('business_profile_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('business_profile_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('business_profile');
	}

}
