<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/storage-link', function () {
  Artisan::call('storage:link');
  dd('Storage linked!');
});
Route::get('/db-seed', function () {
  Artisan::call('db:seed --class=OutlerSeeder');
  dd('db seeded!');
});
Route::get('/config-cache', function () {
  Artisan::call('config:cache');
  dd('config cleared!');
});
Route::get('/migrate', function () {
  Artisan::call('migrate', [
      '--force' => true,
  ]);
  dd('migrated!');
});

Route::get('/', [Controller::class,'index'])->name('home');
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/login', [LoginController::class,'post'])->name('actionlogin');

Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);
