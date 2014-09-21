<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courseclasses', function($table){
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->foreign('group_id')->references('id')->on('groups');
			$table->integer('course_id')->unsigned();
			$table->foreign('course_id')->references('id')->on('courses');
			$table->string('day');
			$table->string('start_time');
			$table->string('end_time');
			$table->string('class_location');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courseclasses');
	}

}
