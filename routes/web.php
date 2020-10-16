<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::group(['namespace' => 'Admin'], function () {

   ######################### Begin products Routes ########################
        Route::group(['prefix' => 'products'], function () {

                Route::get('/', 'ProductController@index')->name('services');
                Route::get('getdata', 'ProductController@getdata')->name('services.getdata');
                Route::post('postdata', 'ProductController@postdata')->name('services.postdata');
                // Rout Of Update
                Route::get('fetchdata', 'ProductController@fetchdata')->name('services.fetchdata');
                //Route Of Delete 
                Route::get('removedata', 'ProductController@removedata')->name('services.removedata');

         });
    ######################### End  products Routes  ########################

                    //uploaded Media
                    Route::get('media/{idproduct}', 'MediaProductController@index')->name('media');
                    Route::get('media', 'MediaProductController@show')->name('media');
                    Route::get('media/getdata/{idproduct}', 'MediaProductController@getdata')->name('media.getdata');
                    Route::post('media/postdata', 'MediaProductController@postdata')->name('media.postdata');
                    Route::get('media/fetchdata/{id}', 'MediaProductController@fetchdata')->name('media.fetchdata');
                    Route::get('media/removedata/{id}', 'MediaProductController@removedata')->name('media.removedata');

});
