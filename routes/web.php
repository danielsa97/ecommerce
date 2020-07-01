<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth');
});

//AUTHENTICATED ROUTES
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::get('image/{image}', 'ImageController@index')->name('image.index');

    //Catalog
    Route::group(['prefix' => 'catalog', 'as' => 'catalog.', 'namespace' => 'Catalog'], function () {

        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::post('/', 'CategoryController@store')->name('store');
            Route::get('{id}/edit', 'CategoryController@edit')->name('edit');
            Route::put('{id}', 'CategoryController@update')->name('update');
            Route::put('{id}/change-status', 'CategoryController@changeStatus')->name('change-status');
            Route::post('category-search', 'CategoryController@categorySearch')->name('search');

        });

        Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
            Route::get('/', 'DepartmentController@index')->name('index');
            Route::post('/', 'DepartmentController@store')->name('store');
            Route::get('{id}/edit', 'DepartmentController@edit')->name('edit');
            Route::put('{id}', 'DepartmentController@update')->name('update');
            Route::put('{id}/change-status', 'DepartmentController@changeStatus')->name('change-status');
            Route::get('department-search', 'DepartmentController@departmentSearch')->name('search');

        });

        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::get('/', 'BrandController@index')->name('index');
            Route::post('/', 'BrandController@store')->name('store');
            Route::get('{id}/edit', 'BrandController@edit')->name('edit');
            Route::put('{id}', 'BrandController@update')->name('update');
            Route::put('{id}/change-status', 'BrandController@changeStatus')->name('change-status');
        });

        Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
            Route::get('/', 'DiscountController@index')->name('index');
            Route::post('/', 'DiscountController@store')->name('store');
            Route::get('{id}/edit', 'DiscountController@edit')->name('edit');
        });

        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/product-search', 'ProductController@productSearch')->name('search');
            Route::group(['prefix' => 'skus', 'as' => 'skus.'], function () {
                Route::get('skus-search', 'SkusController@sKusSearch')->name('search');
            });
        });

    });

    //Setting
    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'namespace' => 'Setting'], function () {

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::post('/', 'UserController@store')->name('store');
            Route::get('{id}/edit', 'UserController@edit')->name('edit');
            Route::put('{id}', 'UserController@update')->name('update');
            Route::put('{id}/change-status', 'UserController@changeStatus')->name('change-status');
        });

        Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
            Route::get('/', 'StoreController@edit')->name('edit');
            Route::put('/', 'StoreController@update')->name('update');
        });
    });


    Route::get('/{any?}', function () {
        return view('page');
    })->where('any', '^(?!api\/)[\/\w\.-]*');


});

