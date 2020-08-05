<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'register' => false
]);

Route::get('/', "BlogsController@lastBlogs");
Route::group([
    'middleware' => "admin",
    'namespace' => "Admin",
    'prefix' => "admin"
], function () {
    Route::resource('categories', "CategoryController")->middleware('auth');
});
Route::resource('blogs', 'BlogsController',  ['except' => ['show', 'index']])->middleware('auth');
Route::get('blogs/{blog}', "BlogsController@show")->name('blogs.show');
Route::get('blogs/filter/{filter}', "BlogsController@index")->name('blogs.index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/profile_edit', 'HomeController@profileEdit')->name('edit-profile');
Route::post('user/profile_edit', 'HomeController@editProfile')->name('user-edit');
Route::get('/registration', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/registration', 'Auth\RegisterController@register')->name('register');
Route::get('/test', function (){
    echo password_hash('kulagin@kineu.kz', PASSWORD_DEFAULT);
});