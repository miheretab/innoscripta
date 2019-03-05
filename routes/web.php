<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
var_dump(env('APP_ENV'));
if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}

Route::get('/', 'BillsController@index')->name('home');
Route::get('companies/add', function () {
    return view('companies.add');
});

