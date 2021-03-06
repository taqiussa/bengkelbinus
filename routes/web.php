<?php

use App\Http\Controllers\BengkelController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');
    Route::get('/customer', [BengkelController::class, 'customer'])->name('customer');
    Route::get('/category', [BengkelController::class, 'category'])->name('category');
    Route::get('/item', [BengkelController::class, 'item'])->name('item');
    Route::get('/service', [BengkelController::class, 'serviceregistration'])->name('service');
    Route::get('/serviceprocess', [BengkelController::class, 'serviceprocess'])->name('serviceprocess');
    Route::get('/servicedone', [BengkelController::class, 'servicedone'])->name('servicedone');
    Route::get('/servicepaid', [BengkelController::class, 'servicepaid'])->name('servicepaid');
});
