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

Route::get('/','InicioController@index')->name('inicio.index');

/*RUTAS PARA RECETAS*/
Route::resource('recetas', 'RecetaController');

/*BUSCADOR PARA RECETAS*/
Route::get('/buscar','RecetaController@search')->name('buscar.show');

//RUTA PARA CATEGORIAS
Route::get('/categorias/{categoriaReceta}', 'CategoriasController@show')->name('categorias.show');

//RUTAS PARA PERFILES
Route::get('/perfiles/{perfil}','PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit','PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}','PerfilController@update')->name('perfiles.update');

//Almacenar los likes
Route::post('/recetas/{receta}','LikesController@update')->name('likes.update');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');@