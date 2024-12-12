<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'confirm' => false, 'forgot' => false]);

Route::get('/', fn () => redirect(route('login')));

Route::get('forgot-password', [ForgotPasswordController::class, 'showPageForgotPassword'])->name('forgot.password');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendEmail']);
Route::get('riset-password', [ForgotPasswordController::class, 'showPageRisetPassword'])->name('riset.password');
Route::patch('riset-password', [ForgotPasswordController::class, 'updatePassword']);



