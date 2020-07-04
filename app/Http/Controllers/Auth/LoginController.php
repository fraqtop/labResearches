<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ExceptionFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return [
                'token' => Auth::user()->createToken('')->plainTextToken,
                'username' => Auth::user()->name
            ];
        } else {
            ExceptionFactory::userNotFound();
        }
    }
}
