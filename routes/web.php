<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth');
});

//ROTAS AUTENTICADAS
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    //Catalog
    Route::group(['prefix' => 'catalog', 'as' => 'catalog.', 'namespace' => 'Catalog'], function () {

        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::post('/', 'CategoryController@store')->name('store');
            Route::get('{id}/edit', 'CategoryController@edit')->name('edit');
            Route::put('{id}', 'CategoryController@update')->name('update');
            Route::put('{id}/change-status', 'CategoryController@changeStatus')->name('change-status');
            Route::post('category-search', 'CategoryController@categorySearch')->name('search');

        });

        Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
            Route::post('/', 'DepartmentController@store')->name('store');
            Route::get('{id}/edit', 'DepartmentController@edit')->name('edit');
            Route::put('{id}', 'DepartmentController@update')->name('update');
            Route::put('{id}/change-status', 'DepartmentController@changeStatus')->name('change-status');
            Route::get('department-search', 'DepartmentController@departmentSearch')->name('search');

        });

        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::post('/', 'BrandController@store')->name('store');
            Route::get('{id}/edit', 'BrandController@edit')->name('edit');
            Route::put('{id}', 'BrandController@update')->name('update');
            Route::put('{id}/change-status', 'BrandController@changeStatus')->name('change-status');
        });

        Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
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
            Route::post('/', 'UserController@store')->name('store');
            Route::get('{id}/edit', 'UserController@edit')->name('edit');
            Route::put('{id}', 'UserController@update')->name('update');
            Route::put('{id}/change-status', 'UserController@changeStatus')->name('change-status');
        });
    });


    //DataTables
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'catalog', 'namespace' => 'Catalog', 'as' => 'catalog.'], function () {
            Route::get('category', 'CategoryController@categoryDatatableAjax')->name('category');
            Route::get('brand', 'BrandController@brandDatatableAjax')->name('brand');
            Route::get('department', 'DepartmentController@departmentDatatableAjax')->name('department');
            Route::get('discount', 'DiscountController@discountDatatableAjax')->name('discount');
        });

        Route::group(['prefix' => 'setting', 'namespace' => 'Setting', 'as' => 'setting.'], function () {
            Route::get('user', 'UserController@userDatatableAjax')->name('user');
        });
    });

    Route::get('/{any?}', function () {
        return view('page');
    })->where('any', '^(?!api\/)[\/\w\.-]*');

});

