<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SigningController extends Controller
{
    public function signin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->has('remember'))) {
            return redirect("/");
        }
        return redirect()->back()->with('fail', 'Authentication failed');
    }
}
