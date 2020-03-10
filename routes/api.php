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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//to display all music uploads
Route::get('/music', 'MusicController@index')->name('music.dispalyall');

Route::get('/album', 'MusicController@index_album')->name('album.dispalyall');


//to display single music
Route::get('/music/{uuid}', 'MusicController@show')->name('music.dispalyone');

//to create new music upload
Route::post('/music/upload', 'MusicController@store')->name('music.upload');

//to update music description i.e title, album, artist etc...
Route::put('/music/update/{uuid}', 'MusicController@update')->name('music.update');

//to delete upload
Route::delete('/music/delete/{uuid}', 'MusicController@destroy')->name('music.delete');

Route::get( 'music/{uuid}/download','MusicController@download')->name('music.download');
