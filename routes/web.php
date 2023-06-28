<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/panel', function () {return view('panel');});
    Route::get('/admin', function () {return view('layouts.admin');})->name('adminpanel');


    Route::get('/usuarios', function () {return view('users.users');})->name('users');
    route::get('/user', [UserController::class, 'index'])->name('user.index');
    // aqui debe ir create
    route::post('/user', [UserController::class, 'store'])->name('user.store');
    route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    // aqui debe ir edit
    route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

});
