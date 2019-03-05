<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
use App\Company;
use App\Bill;
use App\Http\Resources\Company as CompanyResource;
use App\Http\Resources\Bill as BillResource;

//company routes
Route::get('companies', function () {
    return CompanyResource::collection(Company::paginate(15));
});

Route::get('companies/{id}', function ($id) {
    return new CompanyResource(Company::findOrFail($id));
});

Route::post('companies', function(Request $request) {
    return Company::create($request->all());
});

Route::put('companies/{id}', function(Request $request, $id) {
    $company = Company::findOrFail($id);
    $company->update($request->all());

    return new CompanyResource($company);
});

Route::delete('companies/{id}', function($id) {
    Company::find($id)->delete();

    return 204;
});

//bill routes
Route::get('bills/{companyId}', function ($companyId) {
    return BillResource::collection(Bill::where(['company_ID' => $companyId])->paginate(15));
});

Route::get('bills/edit/{id}', function ($id) {
    return new BillResource(Bill::findOrFail($id));
});

Route::post('bills', function(Request $request) {
    return Bill::create($request->all());
});

Route::put('bills/{id}', function(Request $request, $id) {
    $bill = Bill::findOrFail($id);
    $bill->update($request->all());

    return new BillResource($bill);
});

Route::delete('bills/{id}', function($id) {
    Bill::find($id)->delete();

    return 204;
});