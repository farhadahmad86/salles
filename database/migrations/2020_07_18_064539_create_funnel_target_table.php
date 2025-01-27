<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunnelTargetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funnel_target', function(Blueprint $table)
		{
			$table->integer('funnel_target_id', true);
			$table->string('funnel_target_your_manager')->nullable();
			$table->string('funnel_target_user_id')->nullable();
			$table->integer('funnel_target_by')->nullable();
			$table->string('funnel_target_product_category')->nullable();
			$table->string('funnel_target_date')->nullable();
			$table->string('funnel_target_role')->nullable();
			$table->string('funnel_target_otc')->nullable();
			$table->string('funnel_target_mrc')->nullable();
			$table->timestamp('funnel_target_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('funnel_target_updated_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('funnel_target');
	}

}
