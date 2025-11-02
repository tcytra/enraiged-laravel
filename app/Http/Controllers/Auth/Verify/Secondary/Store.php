<?php

namespace App\Http\Controllers\Auth\Verify\Secondary;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Store extends Controller
{
    /**
     *  Send a new email verification notification.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedSecondary()) {
            return redirect()
                ->intended($this->route('dashboard'));
        }

        $request->user()
            ->sendSecondaryVerificationNotification();

        return back()
            ->with('status', 201);
    }
}
