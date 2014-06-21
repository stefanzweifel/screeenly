<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApiLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('api_log', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->text('payload');
			$table->text('response');
			$table->text('images');
			$table->timestamps();
			$table->softDeletes();
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('api_log');
	}

}
