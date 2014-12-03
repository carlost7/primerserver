<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreedomainsTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('free_domains', function(Blueprint $table) {
                  $table->increments('id');
                  $table->integer('plan_id')->unsigned();
                  $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade')->onUpdate('cascade');
                  $table->integer('domain_id')->unsigned();
                  $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade')->onUpdate('cascade');
                  $table->integer('user_id')->unsigned();
                  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                  $table->boolean('active');
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
            Schema::drop('free_domains');
      }

}
