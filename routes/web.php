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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');



//for testing;

//to display all music uploads
Route::get('/music', 'MusicFrontendController@index')->name('music.displayall');

//to display single music
Route::get('/music/{uuid}', 'MusicFrontendController@show')->name('music.displayone');

//to create new music upload
Route::post('/music/upload', 'MusicFrontendController@upload')->name('music.upload');

//to update music description i.e title, album, artist etc...
Route::post('/music/save/{uuid}', 'MusicFrontendController@save')->name('music.save'); //---does the update function--// changed the 'PUT' method to 'post' cos of browser incompactibility with 'PUT/PATCH' and 'DELETE'

Route::get('/music/update/{uuid}', 'MusicFrontendController@update')->name('music.update'); //takes User to the update view page;

//to delete upload
Route::get('/music/delete/{uuid}', 'MusicFrontendController@destroy')->name('music.delete'); //changed the 'delete' method to 'get' cos of browser incompactibility with 'PUT/PATCH' and 'DELETE'

Route::get( 'music/{uuid}/download','MusicFrontendController@download')->name('music.download');

