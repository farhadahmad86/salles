<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id');
			$table->integer('business_category_id')->nullable();
			$table->string('com_region_id');
			$table->string('com_sector_id');
			$table->string('com_area_id');
			$table->string('company_name', 191);
			$table->text('comp_remarks', 65535)->nullable();
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
		Schema::drop('company');
	}

}
