<?php

Route::middleware(['web', 'auth'])->group(function () {

	Route::get('profile', 'Aliabdulaziz\LaravelExtendedUser\Controllers\ProfileController@show')->name('profile');
	Route::put('profile', 'Aliabdulaziz\LaravelExtendedUser\Controllers\ProfileController@update');
	Route::get('profile/edit', 'Aliabdulaziz\LaravelExtendedUser\Controllers\ProfileController@edit');
	Route::delete('profile/image', 'Aliabdulaziz\LaravelExtendedUser\Controllers\ProfileController@remove');

	Route::get('account', 'Aliabdulaziz\LaravelExtendedUser\Controllers\AccountController@show')->name('account');
	Route::put('account', 'Aliabdulaziz\LaravelExtendedUser\Controllers\AccountController@update');
	Route::get('account/delete', 'Aliabdulaziz\LaravelExtendedUser\Controllers\AccountController@delete');
	Route::delete('account/delete', 'Aliabdulaziz\LaravelExtendedUser\Controllers\AccountController@destroy');
});