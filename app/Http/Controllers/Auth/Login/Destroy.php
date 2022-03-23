<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Destroy extends \App\Http\Controllers\Auth\Controller
{
    public function __invoke(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
