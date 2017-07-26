<?php

// Store avatar
Route::post('/avatar/store/{avatar?}', 'AvatarController@store')->name('avatar.store');

// Update avatar
Route::put('/avatar/update/{avatar?}', 'AvatarController@update')->name('avatar.update');

// Delete avatar
Route::delete('/avatar/delete/{avatar?}', 'AvatarController@delete')->name('avatar.delete');

// Get a member's avatar
Route::get('/avatar/{avatar}', 'AvatarController@show')->name('avatar.show');

// Get members thumbnail
Route::get('/avatar/{avatar}/size/{size}', 'AvatarController@showThumbnail')->name('avatar.show.thumbnail');