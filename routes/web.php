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

Route::get('/', 'UrlController@index');
Route::post('/', 'UrlController@store');

Route::get('/lang/{locale?}',function($locale='en'){
    session()->put('currentLang',in_array($locale,['vi','en'])?$locale:'en');
    
    //dump(session()->all());
    return redirect('/');
});
/**
 * Auth::routes() is just a helper class that helps you generate all the routes required for user authentication.
 */
//Auth::routes(['register'=>false]); // khong cho user dang ky
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{short}','UrlController@run');