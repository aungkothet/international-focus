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
Route::get('/', function () {
    $companies = \App\Company::all();
    return view('welcome',['companies' => $companies]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/demand_letters/{id}','DemandLetterController@index');
Route::get('/demand_letter/create/{companyID}','DemandLetterController@create');
Route::post('/demand_letter/store', 'DemandLetterController@store');
Route::get('/demand_letter/edit/{demandLetter}', 'DemandLetterController@edit');
Route::post('/demand_letter/update/{demandLetter}', 'DemandLetterController@update');
Route::post('/demand_letter/comment/{demandLetter}', 'DemandLetterController@addComment');
Route::post('/demand_letter/passport/comment/{demandLetter}', 'DemandLetterController@addPassportComment');
Route::post('/demand_letter/contract/comment/{demandLetter}', 'DemandLetterController@addContractComment');
Route::post('/demand_letter/sending/comment/{demandLetter}', 'DemandLetterController@addSendingComment');
Route::post('/demand_letter/summary/comment/{demandLetter}', 'DemandLetterController@addSummaryComment');

Route::get('/demand_letter/detail/{demandLetter}', 'DemandLetterController@show');
Route::get('/demand_letter/passport/{demandLetter}', 'DemandLetterController@showPassportList');
Route::get('/demand_letter/contract/{demandLetter}', 'DemandLetterController@showContractList');
Route::get('/demand_letter/sending/{demandLetter}', 'DemandLetterController@showSendingList');

Route::get('/worker/create/{demandLetterID}', 'NameListController@create');
Route::get('/worker/edit/{nameList}', 'NameListController@edit');
Route::get('/worker/passport/create/{demandLetterID}', 'NameListController@createPassport');
Route::get('/worker/contract/create/{demandLetterID}', 'NameListController@createContract');
Route::get('/worker/sending/create/{demandLetterID}', 'NameListController@createSending');
Route::post('/worker/store', 'NameListController@store');
Route::post('/worker/update/{nameList}', 'NameListController@update');
Route::post('/worker/passport/update', 'NameListController@updatePassport');
Route::post('/worker/contract/update', 'NameListController@updateContract');
Route::post('/worker/sending/update', 'NameListController@updateSending');

Route::get('/demand_letter/lock/{demandLetter}','DemandLetterController@lock')->middleware('auth');

Route::get('/qrcode/download/{nameList}','NameListController@downloadQR');