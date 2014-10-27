<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plans', function(Blueprint $table)
		{
			$table->increments('id');
                  $table->string('name');
                  $table->integer('num_emails');
                  $table->integer('num_databases');
                  $table->integer('num_ftps');
                  $table->integer('quota_emails');
                  $table->integer('quota_databases');
                  $table->integer('quota_ftps');
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
		Schema::drop('plans');
	}

}
