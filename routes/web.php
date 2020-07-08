<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::group(['namespace' => 'Admin'], function () {

    ######################### Begin  Categoris Routes ########################
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/','CategoriesController@index') -> name('admin.categories');
        Route::get('create','CategoriesController@create') -> name('admin.categories.create');
        Route::post('store','CategoriesController@store') -> name('admin.categories.store');
        Route::get('edit/{id}','CategoriesController@edit') -> name('admin.categories.edit');
        Route::post('update/{id}','CategoriesController@update') -> name('admin.categories.update');
        Route::get('delete/{id}','CategoriesController@destroy') -> name('admin.categories.delete');
    });
    ######################### End Categoris Routes  ########################

   ######################### Begin products Routes ########################
        Route::group(['prefix' => 'products'], function () {
            Route::get('/','ProductsController@index') -> name('admin.products');
            Route::get('create','ProductsController@create') -> name('admin.products.create');
            Route::post('store','ProductsController@store') -> name('admin.products.store');
            Route::get('edit/{id}','ProductsController@edit') -> name('admin.products.edit');
            Route::post('update/{id}','ProductsController@update') -> name('admin.products.update');
            Route::get('delete/{id}','ProductsController@destroy') -> name('admin.products.delete');
        });
    ######################### End  products Routes  ########################


});
