<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BookmarkList;
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
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^[A-Za-z0-9_]+$/', sprintf('unique:%s,username', User::class), 'max:40'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],
        ]);

        /** @var User $user */
        $user = User::query()->create([
            'username' => $request->get('username'),
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $user->bookmarkLists()->create(
            [
                'name' => BookmarkList::DEFAULT
            ]
        );

        Auth::login($user);

        return redirect(route('questions.index'));
    }
}
