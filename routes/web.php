<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home');

Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>['auth']],function (){
   Route::get('/dashboard',DashboardController::class)->name('dashboard');
   Route::resource('/roles',RoleController::class);
   Route::resource('/users',UserController::class);
   Route::resource('/backups',\App\Http\Controllers\Backend\BackupsController::class)->only(['index','create','store']);
});
