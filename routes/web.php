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

Route::get('/','MainController@index');
Route::get('/register','RegisterController@index');
Route::post('/registerPost','RegisterController@register');
Route::get('/login',function(){
    return view('login',['message' => NULL]);
});
Route::post('/auth','MainController@login');
Route::get('/kategori/{id}','MainController@showKategori');
Route::get('/addFormKategori/{id}','MainController@showAddFormKategori');
Route::get('/addFormModal/{id}','MainController@showAddFormModal');
Route::post('/pushFormModal','MainController@pushFormModal');
Route::get('/detailDataTransaksi/{nama}','MainController@detailDataTransaksi');
Route::post('/pushKategori','MainController@addKategori');
Route::get('/showMenu','MainController@showMenu');
Route::get('/addFormMenu',function(){
    return view('addFormMenu');
});
Route::post('/addMenu','MainController@addMenu');
Route::post('/addTransaksi','MainController@addTransaksi');
Route::get('/showTransaksi/{id}','MainController@showTransaksi');
Route::get('/addFormTransaksi/{nama}','MainController@addFormTransaksi');
Route::get('/showDetailTransaksi/{nama}','MainController@detailTransaksi');
Route::post('/updateTransaksi/{id}','MainController@updateTransaksi');
Route::get('/insight','MainController@insight');
Route::get('/updateStatusTransaksi/{id}','MainController@updateStatusTransaksi');
