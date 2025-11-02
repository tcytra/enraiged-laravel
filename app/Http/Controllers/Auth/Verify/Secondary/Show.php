<?php

namespace App\Http\Controllers\Auth\Verify\Secondary;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Show extends Controller
{
    /**
     *  Display the email verification prompt.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function __invoke(Request $request): InertiaResponse|RedirectResponse
    {
        $props = [
        ];

        return ! $request->user()->mustVerifySecondary || $request->user()->hasVerifiedSecondary()
            ? redirect()
                ->intended($this->route('dashboard'))
            : inertia('auth/VerifySecondary', $props);
    }
}
