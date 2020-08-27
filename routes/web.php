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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

/*---------------Login --------------*/
Route::get('/admin', 'Cms\LoginController@index');

//Metodo posts
Route::post('/cms/login', 'Cms\LoginController@login')->name('login.admin');
Route::post('/admin/logout', 'Cms\LoginController@logout')->name('login.logout');

//CMS
Route::middleware('admin')->group(function () {
	Route::get('/cms', 'Cms\IndexController@index')->name('cms.home');

	/*---------------Usuarios --------------*/
	Route::get('/cms/admin_users', 'Cms\IndexController@adminUsers')->name('cms.users');
	Route::get('/cms/get/user/{id}', 'Cms\UserController@getUser');
	//Metodo posts
	Route::post('/cms/user/create', 'Cms\UserController@makeUser')->name('cms.users.create');
	Route::post('/cms/update/user/{id}', 'Cms\UserController@editUser');
	Route::post('/cms/password/user/{id}', 'Cms\UserController@editPassword');
	Route::post('/cms/eliminar/user/{id}', 'Cms\UserController@eliminarUsuario');
});