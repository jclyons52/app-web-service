<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('backbone/programs', 'BackboneController@programs');
Route::get('backbone/groups', 'BackboneController@groups');
Route::get('backbone/courseclasses', 'BackboneController@courseClasses');

Route::resource('programs', 'ProgramsController');

Route::resource('groups', 'GroupsController');
Route::resource('programs/{program_id}/groups', 'GroupsController');

Route::resource('courseclasses', 'CourseClassesController');
Route::resource('groups/{group_id}/courseclasses', 'CourseClassesController');

Route::resource('courses', 'CoursesController');

Route::get('/', function() { 
	return View::make('home'); 
});
