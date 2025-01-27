<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyPocProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_poc_profile', function(Blueprint $table)
		{
			$table->integer('com_poc_profile_id', true);
			$table->string('com_poc_profile_user_id')->nullable();
			$table->string('com_poc_profile_name')->nullable();
			$table->string('com_poc_profile_company_id')->nullable();
			$table->string('com_poc_profile_designation')->nullable();
			$table->string('com_poc_profile_mobile_no')->nullable();
			$table->string('com_poc_profile_whatsapp_no')->nullable();
			$table->string('com_poc_profile_email')->nullable();
			$table->string('com_poc_profile_status')->nullable();
			$table->string('com_poc_profile_address')->nullable();
			$table->timestamp('com_poc_profile_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('com_poc_profile_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('company_poc_profile');
	}

}
