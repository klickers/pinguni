<?php

use Illuminate\Support\Facades\Route;

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

/*
 *
 *  Test Routes
 *
 */



/*
 *
 *  Main Routes
 *
 */
/*
 *  Routes for authentication
 */
Auth::routes();

Route::get('/', 'MainController@index')->name('home');
Route::view('about', 'about');
Route::get('search/{type?}', 'MainController@search');



/*
 *
 *  Profile Routes
 *
 */
Route::get('/u/{username}', 'UserController@profile');


/*
 *
 *  Resource Routes
 *
 */
Route::prefix('resources')->group(function() {
    
    Route::get('/', 'ResourceController@index');
    
    /**
     *  Search Routes
     */
    Route::get('search/{type?}', 'MainController@search');
    Route::get('get/cards/{tags}', 'ResourceController@cards');
    
    /**
     *  Card Routes
     */
    Route::get('view/{type}s/{permalink}', 'ResourceController@view')->name('viewResource');
    Route::prefix('cards')->group(function() {
        Route::post('store', 'UsersCardsProgressController@store')->name('storeCardProgress');
        Route::post('update', 'UsersCardsProgressController@update')->name('updateCardProgress');
    });
    
    /**
     *  Report routes
     */
    Route::get('links/report', 'ResourceController@report');
    
    /**
     *  Course Routes
     */
    Route::prefix('courses')->group(function() {
        Route::get('{course}', 'ResourceController@course');
        Route::get('{course}/{pocket}', 'ResourceController@coursePocket');
        Route::get('{course}/{pocket}/{page}', 'ResourceController@coursePage');
        //Route::get('{course}/{pocket}/{page}/complete', 'UsersCardProgressController@coursePage');
    });
    
});



/*
 *
 *  Dashboard Routes
 *
 */
/**
 *  View index page route
 */
Route::get('dash', 'DashController@index');

Route::prefix('dash')->group(function() {
        
});




/*
 *
 *  Admin Routes
 *
 */
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
    Route::prefix('admin')->group(function() {
        Route::get('/', 'AdminController@index')->name('admin');
        Route::prefix('create')->group(function() {
            Route::get('/card', 'AdminController@createCard')->name('createCard');
            Route::post('/card/store', 'CardController@store')->name('storeCard');
        });
        Route::prefix('edit')->group(function() {
            Route::post('/card/redirect', 'CardController@redirect')->name('redirectCard');
            Route::get('/card/{id}', 'AdminController@editCard')->name('editCard');
            Route::post('/card/{id}/post', 'CardController@update')->name('updateCard');
        });
    });
});



