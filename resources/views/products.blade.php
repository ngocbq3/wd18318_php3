@extends('layout')

@section('title', 'Trang danh sách sản phẩm')

@section('content')
    <h2>Danh sách bài viết</h2>
    <hr>
    @foreach ($posts as $post)
        <div>
            <a href="#">
                <h3>{{ $post->title }}</h3>
            </a>
            <div>{{ $post->description }}</div>
            <hr>
        </div>
    @endforeach
@endsection
