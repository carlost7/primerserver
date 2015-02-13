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
                  $table->string('concept')->nullable();
                  $table->string('ammount')->nullable();
                  $table->string('currency')->nullable();
                  $table->string('description')->nullable();
                  $table->date('date_start')->nullable();
                  $table->date('date_end')->nullable();
                  $table->boolean('active');
                  $table->string('no_order')->nullable();
                  $table->string('status')->nullable();
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
