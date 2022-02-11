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
    // How cool would this be?
    Route::get('/', function () {
        return view('home');
    })->name('home')->fluent('static.home');
    // Here we specify a path to the JSON language file
    // e.g: /storage/fluent/home.json
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/how', function () {
    return view('how');
})->name('how');

Route::get('/example', function () {
    return view('example');
})->name('example');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
