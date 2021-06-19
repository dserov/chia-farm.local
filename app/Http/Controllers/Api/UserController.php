<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getById($user_id)
    {
        $user = User::findOrFail($user_id);
        return response()->json($user);
    }
}
