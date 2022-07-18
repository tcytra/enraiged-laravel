<?php

namespace Enraiged\Http\Controllers\Accounts\Impersonate;

use Enraiged\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Stop extends Controller
{
    /**
     *  Handle an end impersonation request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $request->session()->forget('impersonate');

        $request->session()->put('status', 205);
        $request->session()->put('success', 'Stopped impersonating.');

        return redirect('/');
    }
}
