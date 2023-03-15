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
})->name('welcome');

Route::get('/tailwind/{filterDisplayMethod?}', function ($filterDisplayMethod = 'popover') {
    return view('tw', ['filterDisplayMethod' => $filterDisplayMethod]);
})->name('tw');

Route::get('/bootstrap-4/{filterDisplayMethod?}', function ($filterDisplayMethod = 'popover') {
    return view('bs4', ['filterDisplayMethod' => $filterDisplayMethod]);
})->name('bs4');

Route::get('/bootstrap-5/{filterDisplayMethod?}', function ($filterDisplayMethod = 'popover') {
    return view('bs5', ['filterDisplayMethod' => $filterDisplayMethod]);
})->name('bs5');
