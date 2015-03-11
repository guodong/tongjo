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
Route::resource('projecthome', 'ProjectHomeController');
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
Route::resource('teambuild', 'TeamBuildController');
Route::resource('commentlist', 'CommentListController');
Route::resource('school', 'SchoolController');
Route::resource('major', 'MajorController');
//Route::resource('team.user.status', 'TeamUserStatusController');
Route::resource('user.avatar', 'UserAvatarController');
Route::resource('projectdetail', 'ProjectDetailController');
Route::resource('projectlist', 'ProjectListController');
Route::resource('login', 'LoginController');
Route::resource('homepage', 'HomePageController');
Route::resource('project.team', 'ProjectTeamController');
Route::resource('tag', 'TagController');
Route::resource('user.tag', 'UserTagController');
Route::resource('user.tag.pivot', 'UserTagPivotController');
Route::resource('comment', 'CommentController');
Route::resource('project.user.pivot', 'ProjectUserPivotController');
Route::resource('message', 'MessageController');
Route::resource('from.message', 'FromMessageController');
Route::resource('to.message', 'ToMessageController');
Route::resource('user.message', 'UserMessageController'); //同时包含from和to
Route::resource('reply', 'ReplyController');
Route::resource('team.user.pivot', 'TeamUserPivotController');
Route::resource('user.experience', 'UserExperienceController');
Route::resource('session', 'SessionController');
Route::resource('project.tag', 'ProjectTagController');
Route::resource('project.tag.pivot', 'ProjectTagPivotController');
Route::get('/email/send', 'EmailController@send');

