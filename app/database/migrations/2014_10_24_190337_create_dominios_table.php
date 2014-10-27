<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDominiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('domains', function(Blueprint $table)
		{
			$table->increments('id');
                  $table->string('domain');                                    
                  $table->boolean('active');
                  $table->date('date_start');
                  $table->date('date_end');
                  $table->integer('plan_id')->unsigned();
                  $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade')->onUpdate('cascade');
                  $table->integer('user_id')->unsigned();
                  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');                  
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
		Schema::drop('domains');
	}

}
