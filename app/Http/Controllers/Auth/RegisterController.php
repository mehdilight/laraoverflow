<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('pages.auth.register.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::query()->create([
            'username' => $request->get('username'),
            'email'    => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        Auth::login($user);

        return redirect(route('questions.index'));
    }
}
