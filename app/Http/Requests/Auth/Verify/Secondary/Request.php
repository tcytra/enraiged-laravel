<?php

namespace App\Http\Requests\Auth\Verify\Secondary;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class Request extends EmailVerificationRequest
{
    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        if (! hash_equals((string) $this->user()->getKey(), (string) $this->route('id'))) {
            return false;
        }

        if (! hash_equals(sha1($this->user()->getSecondaryForVerification()), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }

    /**
     *  Fulfill the secondary email verification request.
     *
     *  @return void
     */
    public function fulfill()
    {
        if (! $this->user()->hasVerifiedSecondary()) {
            $this->user()->markSecondaryEmailAsVerified();

            event(new Verified($this->user()));
        }
    }
}
