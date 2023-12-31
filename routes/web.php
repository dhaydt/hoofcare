<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Models\Item;
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

Route::get('/route-build', function () {
  $item = Item::get();
  foreach($item as $i){
    $i['online_link'] = route('item.detail', [$i['id'], urlencode($i['name'])]);
    $i->save();
  }
  dd('successfully!');
});

Route::get('/', [Controller::class,'index'])->name('home');

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'post'])->name('actionlogin');

Route::get('/register', [LoginController::class,'register'])->name('register');
Route::post('/register', [LoginController::class,'postRegister'])->name('actionRegister');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/redirect/facebook', [LoginController::class, 'redirectToProviderFacebook']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);
Route::get('/auth/facebook/callback', [LoginController::class, 'handlefbProviderCallback']);

Route::get('details/{id}/{title}', [Controller::class, 'details'])->name('item.detail');
Route::get('flipped/{id}/{title}', [Controller::class, 'flipped'])->name('flipped');

Route::get('/home_menu/{id}/{title}', [Controller::class, 'dynamic_menu'])->name('home_menu');
Route::get('/privacy_policy', [Controller::class, 'privacy'])->name('privacy');
Route::get('/contact', [Controller::class, 'contact'])->name('contact');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
  Route::post('/edit-profile', [UserController::class, 'updateProfile'])->name('user.update.profile');

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
  Route::get('/library', [DashboardController::class, 'library'])->name('user.dashboard.library');
  Route::get('/detail_item/{id}', [DashboardController::class, 'detail_item'])->name('user.detail.item');
  Route::get('/add_item', [DashboardController::class, 'add_item'])->name('user.add.item');
  Route::post('/post_item', [DashboardController::class, 'post_item'])->name('post.items');
  Route::post('/update_item', [DashboardController::class, 'update_item'])->name('update.items');
  Route::get('/view_pdf/{file}', [DashboardController::class, 'view_pdf'])->name('view_pdf');

  Route::get('/menu/{id}/{title}', [DashboardController::class, 'dynamic_menu'])->name('menu_list');

  Route::post('page', [GraphController::class, 'publishToPage'])->name('page');
  Route::get('/facebook', [LoginController::class, 'redirectToFacebookProvider'])->name('facebook');
  Route::get('/facebook/callback', [LoginController::class, 'hadnleProviderFacebookCallback'])->name('facebook.callback');
  Route::post('/facebook_page_id', [LoginController::class, 'facebook_page_id'])->name('facebook_page_id');
});
