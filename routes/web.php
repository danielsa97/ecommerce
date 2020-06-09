<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth');
});

//ROTAS AUTENTICADAS
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'HomeController@index')->name('home');

    //Catalog
    Route::group(['prefix' => 'catalog', 'as' => 'catalog.', 'namespace' => 'Catalog'], function () {

        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::post('/', 'CategoryController@store')->name('store');
            Route::get('/{id}/edit', 'CategoryController@edit')->name('edit');
            Route::put('/{id}', 'CategoryController@update')->name('update');
            Route::put('/{id}/change-status', 'CategoryController@changeStatus')->name('change-status');
        });

        Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
            Route::get('/', 'DepartmentController@index')->name('index');
            Route::post('/', 'DepartmentController@store')->name('store');
            Route::get('/{id}/edit', 'DepartmentController@edit')->name('edit');
            Route::put('/{id}', 'DepartmentController@update')->name('update');
            Route::put('/{id}/change-status', 'DepartmentController@changeStatus')->name('change-status');
        });

        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::get('/', 'BrandController@index')->name('index');
            Route::post('/', 'BrandController@store')->name('store');
            Route::get('/{id}/edit', 'BrandController@edit')->name('edit');
            Route::put('/{id}', 'BrandController@update')->name('update');
            Route::put('/{id}/change-status', 'BrandController@changeStatus')->name('change-status');
        });

        Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
            Route::get('/', 'DiscountController@index')->name('index');
            Route::post('/', 'DiscountController@store')->name('store');
            Route::get('/{id}/edit', 'DiscountController@edit')->name('edit');
        });
    });

    //Setting
    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'namespace' => 'Setting'], function () {

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::post('/', 'UserController@store')->name('store');
            Route::get('/{id}/edit', 'UserController@edit')->name('edit');
            Route::put('/{id}', 'UserController@update')->name('update');
            Route::put('/{id}/change-status', 'UserController@changeStatus')->name('change-status');
        });
    });


    //DataTables
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'catalog', 'namespace' => 'Catalog', 'as' => 'catalog.'], function () {
            Route::get('category', 'CategoryController@categoryDatatableAjax')->name('category');
            Route::get('brand', 'BrandController@brandDatatableAjax')->name('brand');
            Route::get('department', 'DepartmentController@departmentDatatableAjax')->name('department');
        });

        Route::group(['prefix' => 'setting', 'namespace' => 'Setting', 'as' => 'setting.'], function () {
            Route::get('user', 'UserController@userDatatableAjax')->name('user');
        });
    });
});

