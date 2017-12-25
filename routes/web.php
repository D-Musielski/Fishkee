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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/collections', [
        'uses'  => 'CollectionsController@index',
        'as'    => 'collections'
    ]);
    
    Route::get('/collection/create', [
        'uses'  => 'CollectionsController@create',
        'as'    => 'collection.create'
    ]);
    
    Route::post('/collection/store', [
        'uses'  => 'CollectionsController@store',
        'as'    => 'collection.store'
        ]);
   
    Route::get('/collection/edit/{id}', [
        'uses'  => 'CollectionsController@edit',
        'as'    => 'collection.edit'
    ]);

    Route::post('/collection/update/{id}', [
        'uses'  => 'CollectionsController@update',
        'as'    => 'collection.update'
    ]);

    Route::get('/collection/delete/{id}', [
        'uses'  => 'CollectionsController@delete',
        'as'    => 'collection.delete'
    ]);
});
