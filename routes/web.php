<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop;
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
Route::get('/', [Shop::class, 'home']);
Route::get('/thong-tin-san-pham/{slug}', [Shop::class, 'detail'])->name('thong-tin-san-pham');
Route::get('/danh-muc-san-pham/{slug}', [Shop::class, 'category'])->name('danh-muc-san-pham');
Route::get('/danh-muc-san-pham-con/{slug}', [Shop::class, 'categorycustom'])->name('danh-muc-san-pham-con');
