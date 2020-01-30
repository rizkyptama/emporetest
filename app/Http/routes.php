<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Login
Route::get('/', 'LoginController@index');
Route::post('/actionLogin', 'LoginController@login');
Route::get('/actionLogout', 'LoginController@logout');

//Admin
Route::get('/dashboardAdmin', 'AdminController@dashboard');
Route::get('/anggota', 'AdminController@anggota');
Route::get('/pinjaman', 'AdminController@pinjaman');

//Buku
Route::post('/tambahBuku', 'AdminController@tambahBuku');
Route::get('/editBuku/{kd_buku}', 'AdminController@editBuku');
Route::put('/updateBuku/{kd_buku}', 'AdminController@updateBuku');
Route::delete('/hapusBuku/{kd_buku}', 'AdminController@hapusBuku');

//Anggota
Route::post('/tambahUser', 'AdminController@tambahUser');
Route::get('/editUser/{kd_user}', 'AdminController@editUser');
Route::put('/updateUser/{kd_user}', 'AdminController@updateUser');
Route::delete('/hapusUser/{kd_user}', 'AdminController@hapusUser');

//Pengajuan Buku
Route::get('/detailPengajuan/{kd_pinjam}', 'AdminController@detailPengajuan');
Route::put('/dikembalikan/{kd_pinjam}', 'AdminController@dikembalikan');
Route::put('/approved/{kd_pinjam}', 'AdminController@approved');
Route::delete('/rejected/{kd_pinjam}', 'AdminController@rejected');


//User
Route::get('/dashboardUser', 'UserController@dashboard');
Route::get('/detailPinjam/{kd_buku}', 'UserController@detailPinjam');
Route::post('/pinjam', 'UserController@pinjam');