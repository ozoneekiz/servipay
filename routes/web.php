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
    Route::get('/users', function () {return view('users.users');})->name('user');
    route::get('/users/list', [UserController::class, 'index'])->name('user.index');
    route::post('/user', [UserController::class, 'store'])->name('user.store');
    route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

});
