<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\LiveController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// RECEIVE ACTIVATION STK
Route::get('/get/gv/activa/gv/req/with/stk',[MpesaController::class,'testingstk']);



// stk results for account activation
Route::post('/get/gv/activa/gv/req/with/stk',[LiveController::class,'stKAccActHandler']);


// stk Callback for dipo
Route::post('/get/gv/depo/gv/req/with/stk',[LiveController::class,'stKDepoHandler']);



// B2C results
Route::post('/results/for/bee2see/and/nowqpuduia/',[LiveController::class,'resultsBetwosee']);

// B2C timeout
Route::post('/timeout/for/bee2see/and/nowqpuduia/',[LiveController::class,'timeOutBetwosee']);



// Kazi kwisha
Route::get('/karibu/kanairo/karibu/kenya/finale',[MpesaController::class,'finale']);
Route::get('/karibu/kanairo/karibu/kenya/premere',[MpesaController::class,'premere']);