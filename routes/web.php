<?php

Route::group(['middleware' => 'web'], function() {
	Route::get('/', 'FrontendController@home');
	Route::get('projects', 'FrontendController@projects');
	Route::get('workshop', 'FrontendController@workshop');
	Route::get('locale', 'FrontendController@locale');

	Route::resource('project', 'Frontend\ProjectController');
});

require base_path('routes/auth.php');
require base_path('routes/backend.php');