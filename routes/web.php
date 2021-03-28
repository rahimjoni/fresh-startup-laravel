<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\BackupsController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Backend\SettingsController;


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
   Route::resource('/backups',BackupsController::class);
   Route::get('backups/{file_name}', [BackupsController::class, 'download'])->name('backups.download');
   Route::delete('backups', [BackupsController::class, 'clean'])->name('backups.clean');

    // Profile
    Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/', [ProfileController::class, 'update'])->name('profile.update');

    // Change password
    Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
    Route::post('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Pages
    Route::resource('/pages',PageController::class);
});

// Always end
Route::get('{slug}',[PagesController::class,'index'])->name('page');

Route::group(['as'=>'settings.','prefix'=>'settings'],function (){
    // General Settings
    Route::get('general',[SettingsController::class,'general'])->name('general');
    Route::put('general',[SettingsController::class,'generalUpdate'])->name('general.update');
    // Appearance Settings
    Route::get('appearance',[SettingsController::class,'appearance'])->name('appearance');
    Route::put('appearance',[SettingsController::class,'appearanceUpdate'])->name('appearance.update');
    // Mail Settings
    Route::get('mail',[SettingsController::class,'mail'])->name('mail');
    Route::put('mail',[SettingsController::class,'mailUpdate'])->name('mail.update');
});

// Socialite routes
Route::group(['as' => 'login.', 'prefix' => 'login', 'namespace' => 'Auth'], function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('callback');
});
