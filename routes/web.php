<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any?}', 'Home\HomeController@index')->where('any', '^(?!api\/)[\/\w\.-]*');


