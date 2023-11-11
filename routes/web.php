<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'login'])->name('auth#login');
    Route::get('registerPage',[AuthController::class,'register'])->name('auth#register');

Route::middleware([
    'auth'
])->group(function () {
    Route::get('/dashboard',[AuthController::class,'index'])->name('dashboard');
});
