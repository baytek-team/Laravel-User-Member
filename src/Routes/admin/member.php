<?php

Route::get('pending', 'AdminController@pending')->name('members.pending');
Route::get('deleted', 'AdminController@deleted')->name('members.deleted');
Route::get('administrators', 'AdminController@administrators')->name('members.adminindex');

Route::post('{user}/approve', 'AdminController@approve')->name('members.approve');
Route::post('{user}/decline', 'AdminController@decline')->name('members.decline');
Route::post('{user}/password/email', 'AdminController@sendPasswordResetLink')->name('member.password.email');

Route::resource('/', AdminController::class);