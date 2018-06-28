<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pid')->unsigned()->default(0);
			$table->boolean('post_id')->default(0);
			$table->string('name', 100);
			$table->integer('salary')->unsigned()->default(0);
			$table->string('avatar')->default('default.jpg');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workers');
	}

}
