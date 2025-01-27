<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name')->nullable();
            $table->integer('supervisor')->nullable();
            $table->string('role')->nullable();
            $table->string('email');
            $table->string('username');
            $table->string('mob');
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->string('modular_group')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->nullable()->default('0000-00-00 00:00:00');
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
		Schema::drop('users');
	}

}
