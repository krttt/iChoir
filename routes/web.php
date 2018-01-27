<?php

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

//HOME
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'EventsController@index');




Auth::routes();

//ADMIN
Route::resource('admin', 'AdminController');
Route::resource('admin/profile','ProfileController');
Route::get('admin/choir/{id}','AdminController@choir');
Route::get('admin/discussion/{id}','AdminController@discussion');
Route::get('admin/event/{id}','AdminController@event');


//EVENTS
Route::resource('events', 'EventsController');
Route::resource('choir/events', 'EventsController');
Route::get('choir/events','EventsController@choirEvents');



//DISCUSSIONS
Route::resource('discussions', 'DiscussionsController', ['except' => ['edit', 'update', 'destroy']]);
Route::resource('choir/discussions', 'DiscussionsController', ['except' => ['edit', 'update', 'destroy']]);
Route::get('choir/discussions','DiscussionsController@choirDiscussions');

//COMMENTS
Route::post('discussions/{id}','CommentController@store');
Route::post('events/{id}','CommentController@store');
Route::post('choir/events/{id}','CommentController@store');

//PRIVATE MESSAGES
Route::post('get_notifications','PrivateMessageController@GetNotifications');
Route::get('inbox','PrivateMessageController@inbox');
Route::get('inbox/message/{id}','PrivateMessageController@show');
Route::post('get_messages_sent','PrivateMessageController@GetMessagesSent');
Route::get('inbox/write/{id}','PrivateMessageController@writeMessage');
Route::post('inbox/write','PrivateMessageController@store');

//PROFILE
Route::get('profile/{id}','Controller@profile');



//USER SEARCH
Route::get('search','Controller@getSearch');
Route::post('search','Controller@postSearch');

//CHOIR
Route::resource('choir', 'ChoirController', ['only' => ['create', 'store']]);
Route::get('choir','ChoirController@index');

//NEW MEMBER AND INVITES
Route::get('choir/new_member','ConductorController@newMember');
Route::post('choir/new_member','InvitationController@send');
Route::get('invitation/{invitation_id}/{action}','InvitationController@accept')->name('invitations.send');
//šeit vajag token, nevis vnk uzminamus ID


//FILES
Route::get('/choir/files/','FileentryController@index');
Route::get('choir/files/get/{filename}', [	'as' => 'getentry', 'uses' => 'FileentryController@get']);
Route::post('choir/files/add',[ 'as' => 'addentry', 'uses' => 'FileentryController@add']);

//cits variants
// Route::get('/choir/files/','FileentryController@index');
// Route::post('/choir/files/store','FileentryController@store');
