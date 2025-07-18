<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.register');
        } 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'role' => 'required|in:admin,department_head,finance_head',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
       return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.login');
        }
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
            if (Auth::attempt($credentials)) {
            return redirect()->route('rights-requests.create')->with('success', 'Login successful.');
        }
        return back()->withErrors([
             'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle a logout request to the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');

        // Log out the user
        // Redirect or return response
    }
}
