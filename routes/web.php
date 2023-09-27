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
Route::get('/danh-sach-bai-viet', [Shop::class, 'list_news'])->name('danh-sach-bai-viet');
Route::get('/danh-sach-videos', [Shop::class, 'videos'])->name('danh-sach-videos');
Route::get('/danh-muc-bai-viet/{slug}', [Shop::class, 'category_news'])->name('danh-muc-bai-viet');
Route::get('/bai-viet/{slug}', [Shop::class, 'news'])->name('bai-viet');
Route::get('/chinh-sach/{slug}', [Shop::class, 'policy'])->name('chinh-sach');
Route::get('/tim-kiem',[Shop::class, 'search'])->name('tim-kiem');
