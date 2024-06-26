<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\prodicontroller;
use App\Http\Controllers\mahasiswacontroller;

Route::get('/', function () {
    $data = ['nama' => "Najwa Fitriyani", 'foto' => 'najwa.jpg'];
    return view('dashboard', compact('data'));
})->name('home')->middleware('auth');

Route::get('welcome', function () {
    return view('welcome');
});

// Route::get('/mahasiswa', function () {
//    return view('mahasiswa', ['nama' => "Najwa Fitriyani", 'foto' =>'najwa.jpg']);
// });

// Route::get('/prodi', function () {
//    return view('prodi', ['nama' => "Najwa Fitriyani", 'foto' =>'najwa.jpg']);
// });

// Route::get('/prodi', 'App\Http\Controllers\prodicontroller@index');
// Route::get('/prodi', [prodicontroller::class, 'index']);
// Route::get('/prodi/create', [prodicontroller::class, 'create']);
// Route::post('/prodi', [prodicontroller::class, 'store']);

Route::resource('/prodi', prodicontroller::class)->except('index')->middleware('admin');
Route::get('/prodi', [prodicontroller::class, 'index'])->middleware('auth');

// Route::get('/mahasiswa', 'App\Http\Controllers\mahasiswacontroller@index');
// Route::get('/mahasiswa', [mahasiswacontroller::class, 'index']);
// Route::get('/mahasiswa/{id}', [mahasiswacontroller::class, 'show']);
// Route::get('/mahasiswa/create', [mahasiswacontroller::class, 'create']);
// Route::post('/mahasiswa', [mahasiswacontroller::class, 'store']);

Route::resource('/mahasiswa', mahasiswacontroller::class)->except('index')->middleware('auth');
Route::get('/mahasiswa', [mahasiswacontroller::class, 'index'])->middleware('auth');

Route::get('/login', [logincontroller::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [logincontroller::class, 'authenticate']);

Route::post('/logout', [logincontroller::class, 'logout']);