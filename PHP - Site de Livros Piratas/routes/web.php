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

Route::get('/', 'LivroController@index');

Route::get('nao-vai-achar-essa-url-otario', "LivroController@create");
Route::post('nao-vai-achar-essa-url-otario', "LivroController@store")->name('livro.post');

Route::get('/livros/{any}/{livro}', 'LivroController@show');
