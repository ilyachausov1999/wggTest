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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::post('/add', [App\Http\Controllers\HomeController::class, 'add'])->name('add');


Auth::routes();

Route::get('/home', [App\Http\Controllers\SiteController::class, 'home'])->name('home');
Route::get('/home/create', [App\Http\Controllers\SiteController::class, 'create'])->name('create');
Route::post('/home/store', [App\Http\Controllers\SiteController::class, 'store'])->name('store');
Route::get('/home/view', [App\Http\Controllers\SiteController::class, 'viewForms'])->name('viewForms');
Route::get('/home/form{id}show', [App\Http\Controllers\SiteController::class, 'show'])->name('show');
Route::get('/home/form{id}edit', [App\Http\Controllers\SiteController::class, 'edit'])->name('edit');
Route::post('/home/form{id}update', [App\Http\Controllers\SiteController::class, 'update'])->name('update');
Route::get('/home/form{id}delete', [App\Http\Controllers\SiteController::class, 'destroy'])->name('delete');

