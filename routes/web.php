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
    return view('index');
});

Route::get('buku_tamu/data', 'BukuTamuController@listData')->name('buku_tamu.data');
Route::resource('buku_tamu', 'BukuTamuController');

Route::get('wisma1/data', 'WismaController@listDataWisma1')->name('wisma1.data');
Route::get('wisma1', 'WismaController@wisma1');
Route::get('wisma1/{id}/edit', 'WismaController@edit');
//Route::post('wisma1/store', 'WismaController@saveWisma1')->name('wisma1.store');

Route::get('wisma/{id}/data', 'WismaController@listDataNik')->name('wisma.data');
Route::get('wisma1/{id}/tambah', 'WismaController@addOrang');
Route::post('wisma1/store', 'WismaController@saveOrang')->name('wisma1.store');
