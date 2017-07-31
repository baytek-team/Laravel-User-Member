<?php

Route::get('/', 'AdminController@index');

Route::get('pending', 'AdminController@pending')->name('members.pending');
Route::get('deleted', 'AdminController@deleted')->name('members.deleted');
Route::get('administrators', 'AdminController@administrators')->name('members.adminindex');

Route::post('member/{user}/approve', 'AdminController@approve')->name('members.approve');
Route::post('member/{user}/decline', 'AdminController@decline')->name('members.decline');
Route::post('member/{user}/password/email', 'AdminController@sendPasswordResetLink')->name('member.password.email');

Route::resource('member', AdminController::class);