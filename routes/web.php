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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/work', 'HomeController@work')->name('work');
Route::post('/work', 'HomeController@working' )->name('working');
Route::post('/training', 'HomeController@train' )->name('training');
Route::get('/equip', 'HomeController@equip');
Route::get('/unEquip', 'HomeController@unEquip');

Route::group(['middleware'=>['web','auth']], function () {
    Route::get('/show/{id}', function ($id){
        return view('stats',compact('id'));
    });

    Route::get('/training', function () {
        return view('training');
    });

});

Route::group(['middleware'=>['web','auth', 'IsAdmin']], function(){
    Route::resource('/admin/logs', 'LogController');
    Route::resource('/admin/items', 'ItemController');
});