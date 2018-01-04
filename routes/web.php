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

    Route::get('/card/delete/{collection_id}/{id}', [
        'uses'  => 'CardsController@deleteCard',
        'as'    => 'card.delete'
    ]);

    Route::get('/card/update/{collection_id}/{card_id}/{front}-{back}', [
        'uses'  => 'CardsController@update',
        'as'    => 'card.update'
    ]);

    Route::get('/learn', [
        'uses'  => 'LearnController@index',
        'as'    => 'learn'
    ]);

    Route::get('/learn/{id}', [
        'uses'  => 'LearnController@learn',
        'as'    => 'learn.start'
    ]);
    
    Route::post('/learn/{collection_id}/{card_id}', [
        'uses'  => 'LearnController@know',
        'as'    => 'learn.know'
    ]);

    Route::get('/groups', [
        'uses'  => 'GroupsController@index',
        'as'    => 'groups'
    ]);

    Route::get('/group/create', [
        'uses'  => 'GroupsController@create',
        'as'    => 'group.create'
    ]);
    
    Route::post('/group/store', [
        'uses'  => 'GroupsController@store',
        'as'    => 'group.store'
    ]);

    Route::get('/group/edit/{id}', [
        'uses'  => 'GroupsController@edit',
        'as'    => 'group.edit'
    ]);

    Route::get('/group/delete/{id}', [
        'uses'  => 'GroupsController@destroy',
        'as'    => 'group.delete'
    ]);
});
