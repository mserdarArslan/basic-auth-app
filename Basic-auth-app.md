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

## 3. Create the MainController

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
