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

Route::get('/', function()
{
	return View::make('hello');
});
Route::resource('user', 'UserController');
Route::resource('project', 'ProjectController');
Route::resource('user.type.project', 'UserTypeProjectController');
Route::resource('accesstoken', 'AccesstokenController');
Route::resource('category.project', 'CategoryProjectController');
Route::resource('user.team', 'UserTeamController');
Route::resource('team.user', 'TeamUserController');
Route::resource('category', 'CategoryController');
Route::resource('team', 'TeamController');
Route::resource('school', 'SchoolController');
Route::resource('major', 'MajorController');