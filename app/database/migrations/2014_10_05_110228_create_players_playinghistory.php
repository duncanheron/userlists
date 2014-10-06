<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersPlayinghistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players_playing', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('player_id');
            $table->integer('week_as_int');
            $table->integer('response');
            // $table->string('email');

            // created_at, updated_at DATETIME
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
		//
	}

}
