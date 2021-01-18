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

Route::get('messages_send', 'MessagesController@messages_send')->name('messages_send');
Route::post('stock_filter', 'StockController@stock_filter')->name('stock_filter');


Route::resource('agents', 'AgentController');
Route::resource('products', 'ProductController');
Route::resource('stock', 'StockController');
Route::resource('vendors', 'VendorController');

Route::resource('messages', 'MessagesController');


Route::get('opening_stock/{id}', 'StockController@opening_stock')->name('opening_stock');
