<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth');
});

//ROTAS AUTENTICADAS
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'namespace' => 'Setting'], function () {
        Route::get('user', 'UserController@index')->name('user.index');
    });
});

