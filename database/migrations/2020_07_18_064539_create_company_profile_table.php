<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_profile', function(Blueprint $table)
		{
			$table->integer('comprofile_id', true);
			$table->string('comprofile_user_id')->nullable();
			$table->string('comprofile_company_id')->nullable();
			$table->string('comprofile_name')->nullable();
			$table->string('comprofile_ptcl')->nullable();
			$table->string('comprofile_address')->nullable();
			$table->string('comprofile_mobile_no')->nullable();
			$table->string('comprofile_whatsapp_no')->nullable();
			$table->string('comprofile_email')->nullable();
			$table->string('comprofile_status')->nullable();
			$table->string('comprofile_web_address')->nullable();
			$table->dateTime('comprofile_created_at')->nullable();
			$table->dateTime('comprofile_updated_at')->nullable();
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
		Schema::drop('company_profile');
	}

}
