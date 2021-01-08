<?php

use Illuminate\Support\Facades\Route;

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
    return view('sms');
});

Route::get('/portal', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('sms', 'SmsController@sms')->name('sms');

Route::resource('report', 'CallcenterController');
Route::resource('riders', 'RiderController');
Route::post('filter', 'CallcenterController@filter')->name('filter');
Route::post('rider_filter', 'RiderController@rider_filter')->name('rider_filter');


Route::any('export', 'CallcenterController@export')->name('export');
Route::any('rider_report', 'RiderController@export')->name('export');
