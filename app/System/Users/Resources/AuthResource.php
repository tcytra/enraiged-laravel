<?php

namespace App\System\Users\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /** @var  string  The "data" wrapper that should be applied. */
    public static $wrap = 'user';

    /**
     *  Transform the resource into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'locale' => $this->locale,
            'name' => $this->name,
            'username' => config('enraiged.auth.allow_username_login')
                || (config('enraiged.auth.allow_secondary_credential') && $this->usernameIsEmailAddress)
                ? $this->username
                : null,
        ];
    }
}
