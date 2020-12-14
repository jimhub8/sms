<?php

use App\Models\Voice;
// use Illuminate\Support\Facades\Log;
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
    return view('welcome');
});


// Route::post('/call', 'VoiceController@initiateCall')->name('initiate_call');
// Route::post('incoming/call', 'IncomingCallController@incoming')->name('incoming');

Route::resource('incoming', 'IncomingCallController');


// Route::view('/', 'call');
Route::any('/call', 'VoiceController@initiateCall_twilio')->name('initiate_call');


Route::get('/twilio_token', 'VoiceController@twilio_token')->name('twilio_token');
Route::get('/dial_call', 'VoiceController@dial_call')->name('dial_call');


Route::get('/voice_data', 'VoiceController@voice_data')->name('voice_data');
Route::get('/incoming_call', 'VoiceController@incoming')->name('incoming');


Route::post('twilio/incoming/digits', 'ProcessIVRDigitsController');

Route::post('sms', 'SmsController@sms')->name('sms');
