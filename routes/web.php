<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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
    return view('dashboard');
});
Route::resource('student','StudentController');
Route::get('student/edit/{id}','StudentController@editUser');
Route::post('updateUser', 'StudentController@update');
Route::get('student/delete/{id}','StudentController@deleteUser');

Route::resource('markentry','MarkEntryController');
Route::get('markentry/edit/{id}','MarkEntryController@editUser');
Route::post('updateUserMark', 'MarkEntryController@update');
Route::get('markentry/delete/{id}','MarkEntryController@deleteUser');