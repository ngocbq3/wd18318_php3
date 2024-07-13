<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\DB;
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

//Posts
Route::get('/posts', function () {
    // $posts = DB::table('posts')->get();
    //Lấy ra title và view
    // $posts = DB::table('posts')
    //     ->select('title', 'view')
    //     ->limit(10)
    //     ->get();
    //Lấy ra tất cả bài viết có lượt xem (view) > 500
    // $posts = DB::table('posts')
    //     ->where('view', '>', 500)
    //     ->get();
    //JOIN categories và posts
    // $posts = DB::table('posts')
    //     ->join('categories', 'cate_id', 'categories.id')
    //     ->get();
    $posts = DB::table('posts')
        ->orderBy('view', 'desc')
        ->limit(8)
        ->get();
    return $posts;
});

Route::get('/posts-list/{id}', function ($id) {
    $posts = DB::table('posts')
        ->where('cate_id', '=', $id)
        ->get();
    return view('products', compact('posts'));
});
Route::get('/detail/{id}', function ($id) {
    $post = DB::table('posts')->where('id', $id)->first();
    return $post;
})->name('post.detail');

Route::get('/category/list', [CategoryController::class, 'index'])->name('category.index');
