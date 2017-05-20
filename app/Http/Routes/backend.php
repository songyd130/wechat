<?php
/**
 * @author:     Song Yingdong <songyingdong@kmf.com>
 * @link:       http://www.kmf.com
 * @date:       2017/5/15
 * @time:       15:00
 */

Route::auth();

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('register', 'AuthController@getRegister');
Route::post('register', 'AuthController@postRegister');

Route::get('/', 'IndexController@index');
Route::get('index', 'IndexController@index');

Route::get('index/test', 'IndexController@test');