<?php

namespace App\Http\Controllers\Users\Impersonate;

use App\Http\Controllers\Controller;
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

        if ($request->expectsJson()) {
        }

        $request->session()
            ->flash('status', 205);

        $request->session()
            ->flash('success', __('Stopped impersonating.'));

        return to_route('dashboard');
    }
}
