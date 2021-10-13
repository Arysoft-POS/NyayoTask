<?php

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LiveController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// MPESA ROUTES

Route::group(['middleware' => ['auth']], function() {

    // STKPUSH
    Route::post('stk/push/mpesa/gateway',[LiveController::class,'stkpush'])->name('pushstk')->middleware('auth');


    // REGISTER URLS
    Route::get('registerurls/mpesa/gateway',[LiveController::class,'registerURLS'])->name('registerurls')->middleware('auth');

    // B2C
    Route::post('b2c/mpesa/gateway',[LiveController::class,'b2c'])->name('b2c')->middleware('auth');
       
    });

