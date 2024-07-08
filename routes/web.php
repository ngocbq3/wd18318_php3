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
    return view('test');
});
Route::view('/about-us', 'about')->name('page.about');
Route::get('/product', function () {
    return "Trang sản phẩm";
});
Route::get('/product/{id}', function (int $id) {
    return "ID sản phẩm: $id";
});
Route::get(
    '/product/{id}/comment/{comment_id?}',
    function (int $id, int $comment_id = null) {
        return "Product ID: $id - Comment ID: $comment_id";
    }
);
Route::get('/users/{id}', function ($id) {
    return "USER ID: $id";
})->where('id', '[0-9]+');

//Nhóm với tiền tố
Route::prefix('admin')->group(function () {
    Route::get('/product', function () {
        return "PRODUCT";
    });
    Route::get('/category', function () {
        return "CATEGORY";
    });
});
