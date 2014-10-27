<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatabasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('databases', function(Blueprint $table)
		{
			$table->increments('id');
                  $table->string('nombre');
                  $table->string('usuario');
                  $table->integer('domain_id')->unsigned();
                  $table->foreign('domain_id')->references('id')->on('domain')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('databases');
	}

}
