<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,user');
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->only(['name', 'email']);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        return redirect()->route('home');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function changePassword(User $user)
    {
        return view('user.change-password', ['user' => $user]);
    }

    public function changePasswordSave(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'required|string|confirmed|same:password_confirmation',
            'password_confirmation' => 'required|min:8|string'
        ]);

        $user->update([
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('home');
    }
}
