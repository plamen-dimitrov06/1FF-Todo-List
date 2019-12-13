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

Route::get('/','Index')->name('index');
Route::get('list/create','ListsController@create')->name('list.create');
Route::post('list/save','ListsController@save')->name('list.save');
Route::get('list/{id}','ListsController@edit')->name('list.edit');
Route::put('list/{id}','ListsController@update')->name('list.update');
Route::post('list/delete','ListsController@delete')->name('list.delete');

Route::post('complete', 'TasksController@complete')->name('task.complete');
