<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('comments', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('comment');
            $table->timestamps();
            $table->integer('shirt_id');
            $table->integer('user_id');
            $table->foreign('shirt_id')->references('id')->on('shirts');
            $table->foreign('user_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('comments');
	}

}
