<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Destroy extends Controller
{
    /**
     *  Handle an incoming authentication invalidation request.
     *
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
