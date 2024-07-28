<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function userLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:25',
            'password' => 'required|string|min:6',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('login')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Attempt to log the user in
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('home'); // or any other route
        }

        // Authentication failed
        return redirect()->route('login')
                         ->withErrors(['login_error' => 'These credentials do not match our records.'])
                         ->withInput();
    
        // $validated = $request->validate([
        //     'username' => 'required|string|max:255',
        //     'password' => 'required',
        // ], [
        //     'username.required' => 'The username field is required.',
        //     'password.required' => 'The Password field is required.',
        // ]);
    
        // return redirect()->route('/login')->with('success', 'Form submitted successfully!');
    }

    public function createUser(Request $request){
        return Hash::make('admin@123');
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator);
        }

        // Create a new user
        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
