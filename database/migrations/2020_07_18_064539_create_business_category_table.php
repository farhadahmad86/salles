<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_category', function(Blueprint $table)
		{
			$table->integer('business_category_id', true);
			$table->string('business_category_user_id')->nullable();
			$table->string('business_category_name')->nullable();
			$table->string('business_category_created_at')->nullable();
			$table->string('business_category_updated_at')->nullable();
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
		Schema::drop('business_category');
	}

}
