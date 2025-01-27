<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatProductGrpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cat_product_grp', function(Blueprint $table)
		{
			$table->integer('cat_product_grp_id', true);
			$table->string('product_cat_id')->nullable();
			$table->string('product_grp_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cat_product_grp');
	}

}
