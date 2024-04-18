<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDO;

class UserController extends Controller
{
    //Show register/create form
    public function register()
    {
        return view('users.register');
    }
    //Create a new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required | confirmed | min:6'

        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        //creating new user
        $user = User::create($formFields);

        auth()->login($user);
        return redirect('/')->with('message', 'User created and logged in');
    }

    //logging user out
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have logged out successfully');
    }

    //show login form
    public function login()
    {
        return view('users.login');
    }
    //Authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'

        ]);
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Logged in successfully');
        }
        return back()->withErrors(['email' => 'invalid login credintials'])->onlyInput('email');
    }
}
