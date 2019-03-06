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

use App\Company;

if (env('APP_ENV') != 'local') {
    URL::forceScheme('https');
}

Route::get('/', 'BillsController@index')->name('home');
Route::get('companies/add', function () {
    return view('companies.add');
});
Route::get('companies/edit/{id}', function ($id) {
    $company = Company::findOrFail($id);
    return view('companies.add', compact('company'));
});
Route::post('companies/add', 'CompaniesController@add');
Route::put('companies/edit/{id}', 'CompaniesController@edit');
Route::delete('bills/delete/{id}', 'BillsController@destroy');
