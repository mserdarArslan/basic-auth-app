<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Admin;

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
        $admin->password = $request->password;
        $save = $admin->save();

        if ($save) {
            return back()->with('success', 'User created successfully');
        } else {
            return back()->with('fail', 'Something wrong, try again.');
        }
    }
}