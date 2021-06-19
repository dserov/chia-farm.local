<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Requests\SaveProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        return \View::make('profile.update', [ 'user' => $user ]);
    }

    public function save(SaveProfileRequest $request)
    {
        $data = $request->input();
        if ($data['password']) {
            $user = Auth::user();
            $user->password = \Hash::make($data['password']);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }

        return redirect()->route('dashboard::index');
    }

}
