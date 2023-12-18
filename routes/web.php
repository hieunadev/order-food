<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [OrderController::class, 'index'])->name('orders.index');
Route::post('step-two', [OrderController::class,'postStepOne'])->name('step.one.post');

Route::middleware(['check.step.completion'])->group(function () {
    Route::get('step-two', [OrderController::class, 'stepTwo'])->name('step.two');

    Route::post('step-three', [OrderController::class,'postStepTwo'])->name('step.two.post');
    Route::get('step-three', [OrderController::class,'stepThree'])->name('step.three');

    Route::post('review', [OrderController::class,'postStepThree'])->name('review.post');
    Route::get('review', [OrderController::class,'review'])->name('review');
});

