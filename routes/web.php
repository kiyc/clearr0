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

Route::middleware(['auth'])->get('/home', 'HomeController@index')->name('home');

Route::prefix('api')->name('api.')->middleware(['auth'])->group(function() {
    Route::prefix('groups')->name('group.')->group(function() {
        Route::get('/', 'GroupController@index')->name('index');
        Route::post('/', 'GroupController@store')->name('store');
        Route::patch('/{group}', 'GroupController@update')->name('update');
        Route::delete('/{group}', 'GroupController@remove')->name('remove');
    });

    Route::prefix('tasks')->name('task.')->middleware(['auth'])->group(function() {
        Route::get('/', 'TaskController@index')->name('index');
        Route::post('/', 'TaskController@store')->name('store');
        Route::patch('/{task}', 'TaskController@update')->name('update');
        Route::delete('/{task}', 'TaskController@remove')->name('remove');
    });
});
