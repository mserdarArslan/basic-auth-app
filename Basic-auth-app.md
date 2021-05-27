# Basic Authentication App With Laravel 8 and Bootstrap

## 1. Create a new Laravel project

```bash
laravel new basic-auth-app --git
cd basic-auth-app
php artisan serve
```

## 2. Edit .env file and setup database settings

Make database settings. Database name, user and password.
Change the name of the app (APP_NAME property).
Don't forget to create database.

```
APP_NAME="Basic Authentication App"
...

DB_DATABASE=basic_auth_app
```

## 3. Create the MainController and Login Page

Create the MainController:

```php
php artisan make:controller MainController
```

Open the MainController.php at app\Http\Controllers folder and add the following login function:

```php
    function login()
    {
        return view('auth.login');
    }
```

Open the web.php file at routes folder and add the login root as follows:

```php
use App\Http\Controllers\MainController;

Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
```

Create the view for the login page:

* Create a auth folder under resources\views folder.
* Under auth folder create a file named login.blade.php as follows:

    ```html
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <!-- Bootstrap from CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row" style="margin-top: 45px;">
                <div class="col-md-4 col-md-offset-4">
                    <h4>Login</h4>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter e-mail address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Sign In</button>
                        <br>
                        <a href="">I don't have an account, create an account.</a>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
    ```

We have creted the login page. You can test the login page at: [http://localhost:8000/auth/login](http://localhost:8000/auth/login)

Now let's commit our changes to our git repository:
* ```bash
  git add --all
  git commit -m "Login page created."
  ```
* You can do the same thing using the VS Code editor's git source tracking tool.

## 4. Create Registration Page

* Edit the MainController.php file and add the function for the registration in the MainController class.

    ```php
    function register()
    {
        return view('auth.register');
    }
    ```

* Create the register route in web.php file:

    ```php
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
    ```

* Create register view under resources\views\auth folder:
register.blade.php

    ```html
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
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter e-mail address">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter e-mail address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                        <br>
                        <a href="">I already have an account, Sign In.</a>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
    ```

* Correct the anchor tags in both login and register pages:

    login.blade.php:

    ```html
    <a href="{{ route('auth.register') }}">I don't have an account, create an account.</a>
    ```

    register.blade.php:

    ```html
    <a href="{{ route('auth.login') }}">I already have an account, Sign In.</a>
    ```

## 4. Create the form actions on the registeration page

* Create the save route:

    web.php:

    ```php
    Route::post('/auth/save', [MainController::class, 'save'])->name('auth.save');
    ```

* Edit the register.blade.php file to add the action property to the form. Also add the '@csrf' directive to prevent cross-site request forgery:

    ```html
    <form action="{{ route('auth.save') }}" method="post">
    @csrf
    ```

* Add save function to MainController.php file:

    ```php
    function save(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
    }
    ```

* In order to maintain the last input value in the form fields we can use the ```old``` helper function in the form field values. We can also use the ```error``` helper function within a ``` span``` tag so that in case an invalid value is entered in the form field we can provide feedback to the user about the error. Edit the register.blade.php file as follows:

    ```html
    <form action="{{ route('auth.save') }}" method="post">
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
    ```

## 5. Create the Admin model and migrations

* Create the Admin model with migrations

    ```bash
    php artisan make:model Admin -m
    ```

* Edit the migrations file to add some columns to the admins table:

    ```php
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->text('password');
            $table->timestamps();
        });
    }
    ```

* Create the admins table by running the migrations

    ```bash
    php artisan migrate
    ```

* Edit the validation rule in the MainController.php file to check if the entered e-mail in the form is a unique e-mail in the admins table:

    ```php
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:admins',
        'password' => 'required|min:5|max:12'
    ]);
    ```

## 6. Edit the the MainController.php to save the user data in the admins table

* Add the Admin model to the MainController.php file:

    ```php
    use app\Models\Admin;
    ```

* Edit the save function in the MainController.php file to save the form values to the database:

    ```php
    // Insert the data to the database
    $admin = new Admin();
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->password = $request->password;
    $save = $admin->save();
    ```

* To check if the data is saved successfully edit the MainController.php as follows:

    ```php
    if ($save) {
        return back()->with('success', 'User created successfully');
    } else {
        return back()->with('fail', 'Something wrong, try again.');
    }
    ```

* To display these return messages on the registration page edit the register.blade.php file as follows:

    ```html
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
    ```

* The password data is saved to the table unencrypted. To save the encrypted password instead we can use the ```Hash``` class. Edit the MainController.php file to make this change:

    ```php
    use Illuminate\Support\Facades\Hash;

    ...

    $admin->password = Hash::make($request->password);
    ```
