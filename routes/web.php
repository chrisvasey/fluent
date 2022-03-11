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

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

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

Route::get('/builder', function () {
    return view('builder');
})->middleware(['auth'])->name('builder');

require __DIR__.'/auth.php';
