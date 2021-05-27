<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Admin;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function register()
    {
        return view('auth.register');
    }

    function save(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:5|max:12'
        ]);

        // Insert the data to the database
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $save = $admin->save();

        if ($save) {
            return back()->with('success', 'User created successfully');
        } else {
            return back()->with('fail', 'Something wrong, try again.');
        }
    }

    function check(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        // Check user credentials by querying the database
        $userinfo = Admin::where('email', '=', $request->email)->first();

        // If the user is not found return an error message
        if (!$userinfo) {
            return back()->with('fail', 'Not a valid e-mail address.');
        } else {
            // Check if the password is correct
            if (Hash::check($request->password, $userinfo->password)) {
                // If the password is correct save the logged in
                // user id in the session 
                // and redirect user to the dashboard
                $request->session()->put('LoggedUser', $userinfo->id);
                return redirect('admin/dashboard');
            } else {
                // If the password is not correct return an error message
                return back()->with('fail', 'Incorrect password.');
            }
        }
    }

    function dashboard()
    {
        // Get the user data from the database to pass to the 
        // dashboard page
        $data = ['LoggedUserInfo' => Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.dashboard', $data);
    }
}