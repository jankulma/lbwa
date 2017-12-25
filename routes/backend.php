<?php

Route::group(['prefix' => 'backend'], function () {

    Route::resource('dashboard', 'Backend\DashboardController');

    Route::group(['prefix' => 'cms'], function () {
        Route::resource('/', 'Backend\CMSController');
        Route::resource('/partial', 'Backend\Cms\PartialController');
    });

    Route::resource('settings', 'Backend\SettingsController');

    Route::post('move_project', 'Backend\Settings\CustomSettingsController@moveProject');
    Route::get('first_page_image', 'Backend\Settings\CustomSettingsController@getFirstPageImage');
    Route::post('first_page_image', 'Backend\Settings\CustomSettingsController@updateFirstPageImage');
});
