<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth');
});

Route::get('image/{image}', 'ImageController@index')->name('image.index');
//AUTHENTICATED ROUTES
Route::group(['middleware' => 'auth'], function () {

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

        Route::group(['prefix' => 'ecommerce', 'as' => 'ecommerce.'], function () {
            Route::get('/', 'EcommerceController@index')->name('index');
            Route::put('/update-general', 'EcommerceController@updateGeneral')->name('update-general');
            Route::put('/update-address-and-contact', 'EcommerceController@updateAddressAndContact')->name('update-address-and-contact');
        });
    });


    Route::get('/{any?}', 'HomeController@index')->where('any', '^(?!api\/)[\/\w\.-]*');
});

