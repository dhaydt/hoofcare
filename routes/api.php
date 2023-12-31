<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/login_facebook', [AuthController::class, 'login_facebook']);
Route::post('/login_google', [AuthController::class, 'login_google']);
Route::get('/category', [CategoryController::class, 'getCategory']);
Route::get('/menu', [MenuController::class, 'getMenu']);
Route::get('/home', [MenuController::class, 'home']);

Route::get('/category_menu/{id}', [MenuController::class, 'dynamic_menu']);
Route::get('/details/{id}', [ItemsController::class, 'detail_items']);
Route::get('/flipped/{id}', [ItemsController::class, 'flip_detail_items']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('profile_update', [UserController::class, 'profile_update']);
    Route::get('/menu_dashboard/{id}', [MenuController::class, 'dynamic_menu_dashboard']);
    Route::get('/menu_library', [MenuController::class, 'dynamic_menu_dashboard']);
    Route::post('/update_item', [ItemsController::class, 'item_update']);
    Route::get('/delete_item/{id}', [ItemsController::class, 'delete_item']);
});
