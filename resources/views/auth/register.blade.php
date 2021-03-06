<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 45px;">
            <div class="col-md-4 offset-md-4">
                <h4>Register</h4>
                <hr>
                <form action="{{ route('auth.save') }}" method="post">
                    <form action="{{ route('auth.save') }}" method="post">
                        @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter e-mail address"
                                value="{{ old('name') }}">
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter e-mail address"
                                value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                        <br>
                        <a href="{{ route('auth.login') }}">I already have an account, Sign In.</a>
                    </form>
            </div>
        </div>
    </div>
</body>

</html>