<?php

namespace App\Auth\Services;

use Illuminate\Http\Request;

class FlashMessages
{
    /**
     *  Handle a request for the flashed session data.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array|null
     */
    public function handle(Request $request)
    {
        $flash = [];

        foreach (['data', 'message', 'status', 'success'] as $each) {
            if ($request->session()->has($each)) {
                $flash[$each] = $request->session()->get($each);
                $request->session()->forget($each);
            }
        }

        return $flash;
    }
}
