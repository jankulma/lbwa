<?php

Route::get('backend', 'Auth\LoginController@showLoginForm')->name('backend');

Route::post('backend/send_reset_email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Auth::routes();
