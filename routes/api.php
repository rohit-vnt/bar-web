<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/',function(){
    return "login";
})->name('login');
Route::post('/register',[Api::class,'register']);
Route::post('/login',[Api::class,'login']);
Route::post('/test',[Api::class,'test']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
