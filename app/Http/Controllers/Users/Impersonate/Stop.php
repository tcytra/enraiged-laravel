<?php

namespace App\Http\Controllers\Users\Impersonate;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class Stop extends Controller
{
    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $request->session()->forget('impersonate');

        $request->session()->put('status', 205);
        $request->session()->put('success', 'Stopped impersonating.');

        return redirect(RouteServiceProvider::HOME);
    }
}
