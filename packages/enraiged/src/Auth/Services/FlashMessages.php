<?php

namespace Enraiged\Auth\Services;

use Illuminate\Http\Request;

class FlashMessages
{
    /** @var  array  The flashable session indexes. */
    protected $flashable = [
        'data', 'message', 'status', 'success',
    ];

    /**
     *  Handle a request for the flashed session data.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function handle(Request $request): array
    {
        $flash = [];

        foreach ($this->flashable as $each) {
            if ($request->session()->has($each)) {
                $flash[$each] = $request->session()->get($each);
                $request->session()->forget($each);
            }
        }

        return $flash;
    }
}
