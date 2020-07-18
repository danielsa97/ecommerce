<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('teste', function () {
    dd('aqui');
})->middleware('auth:api');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth.'], function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('refresh', 'AuthController@refresh')->name('refresh');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user')->name('user');
        Route::post('logout', 'AuthController@logout')->name('logout');
    });
});


Route::group(['prefix' => 'public', 'as' => 'public.'], function () {
    Route::group(['prefix' => 'ecommerce', 'as' => 'ecommerce.'], function () {
        Route::get('/info', 'EcommerceController@getInfo')->name('info');
    });

    Route::get('image/{image}', 'ImageController@index')->name('image.index');
});

//AUTHENTICATED ROUTES
Route::group(['middleware' => 'auth:api'], function () {

    Route::get('widget/{name}', 'Home\WidgetController@index')->name('widget.index');

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
            Route::get('brand-search', 'BrandController@departmentSearch')->name('search');
        });

        Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
            Route::get('/', 'DiscountController@index')->name('index');
            Route::post('/', 'DiscountController@store')->name('store');
            Route::get('{id}/edit', 'DiscountController@edit')->name('edit');
        });

        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::post('/', 'ProductController@store')->name('store');
            Route::get('{id}/edit', 'ProductController@edit')->name('edit');
            Route::put('{id}', 'ProductController@update')->name('update');
            Route::put('{id}/change-status', 'ProductController@changeStatus')->name('change-status');
            Route::get('product-search', 'ProductController@productSearch')->name('search');
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

});
