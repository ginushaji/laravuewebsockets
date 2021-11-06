<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\IpCheckController;

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

Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/:id', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment', [PaymentController::class, 'save_payment'])->name('payment.save');
Route::post('/ask-otp', [PaymentController::class, 'ask_otp'])->name('payment.ask_otp');
Route::post('/verify-otp', [PaymentController::class, 'verify_otp'])->name('payment.verify_otp');
Route::post('/approve-payment', [PaymentController::class, 'approve_payment'])->name('payment.approve');
Route::post('/repeat-payment', [PaymentController::class, 'repeat_payment'])->name('payment.repeat');
Route::post('/delete-payment', [PaymentController::class, 'delete_payment'])->name('payment.delete');
Route::post('/delete-all', [PaymentController::class, 'delete_all'])->name('payment.delete_all');
Route::post('/update-status', [PaymentController::class, 'update_status'])->name('payment.update_status');
Route::post('/update-selected', [PaymentController::class, 'update_selected'])->name('payment.update_selected');
Route::get('/getLastVistorsCount', [PaymentController::class, 'getLastVistorsCount'])->name('payment.getLastVistorsCount');

Route::get('/validate-ip-address', [IpCheckController::class, 'validate_address'])->name('validate_ip_address');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
