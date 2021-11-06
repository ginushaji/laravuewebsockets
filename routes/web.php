<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
//use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LocationController;

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

Route::get('/', [PaymentController::class, 'home']);
//Route::get('/', [WelcomeController::class, 'index']);
Route::get('/show-user-location-data', [LocationController::class, 'index']);
