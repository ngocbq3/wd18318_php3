<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container w-50">
        <h1>Đăng nhập</h1>
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('postLogin') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="mb-3">
                <a href="{{ route('register') }}">Đăng ký</a>
            </div>
        </form>
    </div>
</body>

</html>
