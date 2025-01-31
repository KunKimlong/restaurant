<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StaffController;
use App\Models\Branch;
use Illuminate\Support\Facades\Route;

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

Route::get("/login",[AuthController::class,'openLoginForm']);
Route::post("/login",[AuthController::class,'login'])->name('login');

Route::get('/',[HomeController::class,'index'])->name('home');

Route::resource('staff',StaffController::class);

Route::resource('position',PositionController::class);

Route::resource('branch',BranchController::class);
Route::post('/upload-branch-image',[BranchController::class,'uploadAjax'])->name('upload-branch-image');
