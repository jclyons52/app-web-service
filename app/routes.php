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

Route::resource('programs', 'ProgramsController');
Route::resource('groups', 'GroupsController');
Route::resource('classes', 'ClassesController');
Route::resource('courses', 'CoursesController');

Route::get('/', function()
{
	return View::make('home');
});
