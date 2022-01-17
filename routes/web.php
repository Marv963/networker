<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogController;
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


// Route für jeden
Route::get('/', [HomeController::class, 'index'])->name('home');

// Redirect wenn der Nutzer nicht angemeldet ist
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

// Routes für guests/users
Route::group(['middleware' => ['auth']],function(){
    Route::get('/users/profile',[UserController::class, 'edit'])->name('users.editProfile');
    Route::put('/users/profile', [UserController::class, 'update'])->name('users.updateProfile');
    Route::resources(['network' => NetworkController::class]);
    Route::resources(['host' => HostController::class]);
    Route::get('/logs/{id}', [LogController::class, 'index']);
    Route::get('/network/{id}/export', [NetworkController::class, 'export']);
    Route::get('/demandscan', [ScanController::class, 'index'])->name('demandscan');
    Route::get('/scan', [ScanController::class, 'scanNetworks']);
    Route::get('host/edit/{id}',[HostController::class, 'edit'])->name('host.edit');
    Route::put('host/update/{id}',[HostController::class, 'update'])->name('host.update');
    Route::delete('/host/delete/{id}', [HostController::class, 'delete'])->name('host.delete');

});

// Routes für admins
Route::group(['middleware'=>['authadmin']],function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::put('/admin/updatepw/{id}', [AdminController::class, 'updatepw'])->name('admin.updatepw');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
});

Auth::routes();
