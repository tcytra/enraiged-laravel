<?php

namespace App\Http\Controllers\Auth\Verify\Secondary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Verify\Secondary\Request as SecondaryVerificationRequest;
use Illuminate\Http\RedirectResponse;

class Update extends Controller
{
    /**
     *  Mark the authenticated user's email address as verified.
     *
     *  @param  \App\Http\Requests\Auth\Verify\Secondary\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(SecondaryVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedSecondary()) {
            return redirect()
                ->intended($this->route('dashboard').'?verified=1');
        }

        $request->fulfill();

        session()->flash('status', 200);

        return redirect()
            ->intended($this->route('dashboard').'?verified=1');
    }
}
