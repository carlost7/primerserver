<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('payments', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('concept');
                  $table->string('ammount');
                  $table->string('currency');
                  $table->string('description');
                  $table->date('date_start');
                  $table->date('date_end');
                  $table->boolean('active');
                  $table->string('no_order');
                  $table->string('status');
                  $table->integer('domain_id')->unsigned();
                  $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade')->onUpdate('cascade');
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
            Schema::drop('payments');
      }

}
