<?php

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {return view('index');});
Route::get('/404', function () {return view('404');});
Route::get('/blog-detail', function () {return view('blog-detail');});
Route::get('/blog', function () {return view('blog');});
Route::get('/books-media-detail-v1', function () {return view('books-media-detail-v1');});
Route::get('/books-media-detail-v2', function () {return view('books-media-detail-v2');});
Route::get('/books-media-gird-view-v1', function () {return view('books-media-gird-view-v1');});
Route::get('/books-media-gird-view-v2', function () {return view('books-media-gird-view-v2');});
Route::get('/books-media-list-view', function () {return view('books-media-list-view');});
Route::get('/cart', function () {return view('cart');});
Route::get('/checkout', function () {return view('checkout');});
Route::get('/contact', function () {return view('contact');});
Route::get('/home-v2', function () {return view('home-v2');});
Route::get('/home-v3', function () {return view('home-v3');});
Route::get('/news-events-detail', function () {return view('news-events-detail');});
Route::get('/news-events-list-view', function () {return view('news-events-list-view');});
Route::get('/services', function () {return view('services');});
Route::get('/signin', function () {return view('signin');});

