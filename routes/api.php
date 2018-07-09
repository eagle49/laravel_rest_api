<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// For login
Route::post('getlogin','UserController@getlogin');
Route::post('getsignup','UserController@getsignup');
Route::get('getverify/{verify_code}', 'UserController@getverify');
Route::get('sendvcode/{email}', 'UserController@sendvcode');
// Route::get('folder/list', 'ProjectController@getFolderList');
Route::get('teammembers', 'TeamMemberController@getTeamMemberList');
Route::post('sendResetLink', 'UserController@sendResetLink');
Route::get('getresetverify/{verify_code}', 'UserController@getResetVerify');
Route::post('resetPassword', 'UserController@resetPassword');


Route::group(['prefix' => 'folder'], function () {
    Route::get('list', 'ProjectController@getFolderList');
    Route::post('add', 'ProjectController@addFolder');
    Route::post('delete', 'ProjectController@deleteFolder');
    Route::post('get', 'ProjectController@getFolder');
    Route::post('update', 'ProjectController@updateFolder');
});

Route::group(['prefix' => 'team'], function () {
    Route::get('list', 'TeamController@getTeamList');
    Route::post('add', 'TeamController@addTeam');
    Route::post('delete', 'TeamController@deleteTeam');
    Route::post('update', 'TeamController@updateTeam');
});

Route::group(['prefix' => 'teammember'], function() {
    Route::get('list', 'TeamMemberController@getTeamMemberList');
    Route::post('add', 'TeamMemberController@addTeamMember');
    Route::get('delete', 'TeamMemberController@deleteTeamMember');
});

Route::group(['prefix' => 'project'], function() {
    Route::get('list/{folder_id}', 'ProjectController@getProjectList');
    Route::post('add', 'ProjectController@addProject');
});
