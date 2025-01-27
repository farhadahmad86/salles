<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuotationTargetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotation_target', function(Blueprint $table)
		{
			$table->integer('quotation_target_id', true);
			$table->string('quotation_target_your_manager')->nullable();
			$table->string('quotation_target_user_id')->nullable();
			$table->integer('quotation_target_by')->nullable();
			$table->string('quotation_target_product_category')->nullable();
			$table->string('quotation_target_date')->nullable();
			$table->string('quotation_target_role')->nullable();
			$table->string('quotation_target_otc')->nullable();
			$table->string('quotation_target_mrc')->nullable();
			$table->timestamp('quotation_target_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('quotation_target_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('quotation_target');
	}

}
