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

Route::get('NewOrder', function () {

   $GetIDValue = DB::table('tbl_customer')->max('o_id')+1;
        return view('pages.makeorder')->with('OrderNO',$GetIDValue);
        
});

Route::resource('Order','OrderController');

Route::resource('Report','ReportController');

Route::resource('Current','CurrentController');

Auth::routes();



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('PrintCus/{id}', 'OrderController@customerPrint');

Route::get('PrintCom/{id}', 'OrderController@CompanyPrint');

Route::get('updateItem/{id}', 'OrderController@updateItem');

Route::post('Production', 'OrderController@sendProductionfromStock');

Route::post('stock', 'OrderController@sendStockfromDeliver');

Route::get('Cur', 'OrderController@currentOrdrs');

Route::get('ReportCity', 'ReportController@ReportCity');
Route::get('ReportCuslist', 'ReportController@Cuslist');

Route::get('ReportState', 'ReportController@State');
Route::post('Dura', 'ReportController@DurationDate');
Route::post('ReportResualt', 'ReportController@bycity');

Route::post('ByCity', 'ReportController@multicity');

Route::post('CusEx','ReportController@CustomerExcel');
Route::post('CityEx','ReportController@CityExcel');
Route::post('DuraEx','ReportController@DurationExcel');

Route::post('Pro', 'OrderController@getOrder')->name('pro');

Route::get('returnItem/{id}', 'OrderController@showreturn');

Route::post('fetch', 'OrderController@fetch')->name('fetch');

Route::get('SearchCus', 'ReportController@SearchCus');




