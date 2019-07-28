<?php

use Illuminate\Http\Request;


Route::get('/{hash}', 'UrlController@go');
Route::get('/urls/{hash}', 'UrlController@detail');

Route::post('/urls', 'UrlController@insert'); //ok
Route::post('/urls/{hash}', 'UrlController@update');
Route::delete('/urls/{hash}', 'UrlController@delete');

Route::post('/user', 'UserController@getUser'); //ok




