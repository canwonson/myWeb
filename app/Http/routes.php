<?php


Route::get('/', 'IndexController@index');
Route::get('post/{slug}', 'IndexController@showPost');