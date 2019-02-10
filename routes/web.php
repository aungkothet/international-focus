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
Route::get('/demand_letter/detail/{demandLetter}', 'DemandLetterController@show');
Route::get('/worker/create/{demandLetterID}', 'NameListController@create');
Route::post('worker/store', 'NameListController@store');