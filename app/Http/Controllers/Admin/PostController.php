<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        //Lấy toàn bộ dữ liệu
        // $posts = Post::all();

        //Lấy 1 bài viết
        // $posts = Post::all()->first();

        //lấy dữ liệu theo điều kiện
        // $posts = Post::where('cate_id', 1)->get();

        //Lấy ra tất cả các bài post có lượt view > 800
        // $posts = Post::where('view', '>', 800)->get();

        //Tìm kiếm gần đúng
        // $posts = Post::where('title', 'LIKE', '%aut%')->get();

        //Đếm số lượng bài viết có trong bảng Posts
        // $count = Post::where('cate_id', 1)->count();
        // echo $count;

        //Lấy lượt xem lớn nhất
        // $max_view = Post::max('view');
        // echo $max_view;
        //Hiển thị tất cả bài viết (post) có lượt view cao nhất
        // $posts = Post::where('view', $max_view)->get();

        //Insert data
        //1. Dữ liệu được thêm là 1 mảng
        // $data = [
        //     'title' => fake()->text(25),
        //     'image' => fake()->imageUrl(),
        //     'description' => fake()->text(30),
        //     'content' => fake()->paragraph(),
        //     'view' => rand(10, 1000),
        //     'cate_id' => rand(1, 4),
        // ];
        // Post::create($data);
        //2. Thêm dữ liệu bằng đối tượng
        // $post = new Post();
        // $post->title = fake()->text(25);
        // $post->image = fake()->imageUrl();
        // $post->description = fake()->text(30);
        // $post->content = fake()->paragraph();
        // $post->view = rand(1, 1000);
        // $post->cate_id = rand(1, 4);
        // $post->save();
        //update data
        // $post = Post::find(102)->update([
        //     'title' => fake()->text(20) . ' update'
        // ]);

        //xóa bài viết có id = 101
        // Post::find(101)->delete();

        // dd(Auth::user());
        $posts = Post::paginate(10);
        return view('post-list', compact('posts'));
    }
    //Hiển thị form thêm mới
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    //Phương thức lưu dữ liệu thêm vào database
    public function store(Request $request)
    {
        $data = $request->except('image');
        $data['image'] = "";
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }
        //Create data
        Post::query()->create($data);
        return redirect()->route('post.index')->with('message', 'Thêm dữ liệu thành công');
    }

    //Xóa dữ liệu
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message', 'Xóa dữ liệu thành công');
    }

    //Hiển thi form cập nhật
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('categories', 'post'));
    }

    //Cập nhật dữ liệu
    public function update(Request $request, Post $post)
    {
        $data = $request->except('image');
        $old_image = $post->image;
        //Khi người dùng không thay ảnh
        $data['image'] = $old_image;
        //Khi người dùng upload ảnh
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }

        //Cập nhật dữ liệu
        $post->update($data);
        //Xóa file ảnh cũ
        if ($request->hasFile('image')) {
            if (file_exists('storage/' . $old_image)) {
                unlink('storage/' . $old_image); //Xóa file
            }
        }

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }
}
