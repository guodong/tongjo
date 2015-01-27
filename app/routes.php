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
Route::resource('apphome', 'AppHomeController');
Route::resource('user', 'UserController');
Route::resource('registration', 'RegistrationController');
Route::resource('project', 'ProjectController');
Route::resource('image', 'ImageController');
//Route::resource('project.user', 'ProjectUserController');
Route::resource('user.type.project', 'UserTypeProjectController');
Route::resource('accesstoken', 'AccesstokenController');
Route::resource('category.project', 'CategoryProjectController');
Route::resource('user.type.team', 'UserTypeTeamController');
Route::resource('team.user', 'TeamUserController');
Route::resource('category', 'CategoryController');
Route::resource('team', 'TeamController');
Route::resource('teamlist', 'TeamListController');
Route::resource('teamdetail', 'TeamDetailController');
Route::resource('commentlist', 'CommentListController');
Route::resource('school', 'SchoolController');
Route::resource('major', 'MajorController');
//Route::resource('team.user.status', 'TeamUserStatusController');
Route::resource('user.avatar', 'UserAvatarController');
Route::resource('projectdetail', 'ProjectDetailController');
Route::resource('projectlist', 'ProjectListController');
Route::resource('login', 'LoginController');
Route::resource('homepage', 'HomePageController');
Route::resource('project.team', 'ProjectTeamController'); //鑾峰彇鍙傚姞鏌愰」鐩殑鍥㈤槦
Route::resource('tag', 'TagController');
Route::resource('user.tag.pivot', 'UserTagPivotController');
Route::resource('comment', 'CommentController');
Route::resource('project.user.pivot', 'ProjectUserPivotController'); //璁剧疆鍙傚姞鍥㈤槦鐨勭姸鎬�
Route::resource('from.message', 'FromMessageController');
Route::resource('to.message', 'ToMessageController');
Route::resource('user.message', 'UserMessageController'); //鍚屾椂鍖呭惈from鍜宼o

