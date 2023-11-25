<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        // returns true if the field is submitted with the form, false if not
        $remember = $request->filled('remember');

        // auth attempt accepts array of creds, and a remember option
        // uses cookies by default
        if (Auth::attempt($credentials, $remember)) {
            // intended will allow redirect to the page a user attempted to access before signin - fallback is home
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('error', 'invalid credentials');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        // main logout function
        Auth::logout();

        // EXTRA SECURITY STEPS
        // clear out all user info that lives within session
        request()->session()->invalidate();
        // regenerates csrf token w new value to prevent the possiblity of csrf hijacking
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
