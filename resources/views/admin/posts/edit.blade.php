<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Cập nhật bài viết</h1>
        <a href="{{ route('post.index') }}" class="btn btn-primary">Danh sách</a>

        @if (session('message'))
            <div class="alert alert-success mt-2">
                {{ session('message') }}
            </div>
        @endif


        <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" value="{{ $post->title }}" name="title">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Nhập ảnh</label>
                <input class="form-control" type="file" id="fileImage" name="image">
                <br>
                <img id="img" src="{{ asset('/storage/' . $post->image) }}" width="60"
                    alt="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" rows="3" name="description">{{ $post->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Content</label>
                <textarea class="form-control" rows="6" name="content">{{ $post->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">View</label>
                <input type="number" name="view" class="form-control" value="{{ $post->view }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select name="cate_id" id="">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" @if ($cate->id == $post->cate_id) selected @endif>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <script>
        var file_img = document.querySelector('#fileImage');
        var img = document.querySelector('#img');

        //Khi thay đổi file
        file_img.addEventListener('change', function(event) {
            // console.log(URL.createObjectURL(this.files[0]))
            event.preventDefault()
            img.src = URL.createObjectURL(this.files[0])
        })
    </script>
</body>

</html>
