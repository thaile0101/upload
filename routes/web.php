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

Route::get('/dropzone', function () {
    return view('dropzone');
});
Route::get('/upload', function () {
    return view('upload');
});
Route::get('/resumable', function () {
    return view('resumable');
});

Route::post('upload', 'DependencyUploadController@uploadFile');
Route::post('upload-advanced', 'UploadController@upload');
Route::get('history', 'UploadController@history');
Route::get('download/{hash}', 'UploadController@download')->name('download');