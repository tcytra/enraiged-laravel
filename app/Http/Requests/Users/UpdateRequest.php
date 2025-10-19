<?php

namespace App\Http\Requests\Users;

use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use Messages, Rules;

    /**
     *  Update and return the User with the requested attributes.
     *
     *  @param  \Enraiged\Users\Models\User
     *  @return \Enraiged\Users\Models\User
     */
    public function updateUser($user)
    {
        $validated = $this->validated();

        if (key_exists('name', $validated)) {
            $names = explode(' ', $validated['name']);
            $validated['first_name'] = count($names) ? array_shift($names) : null;
            $validated['last_name'] = count($names) ? implode(' ', $names) : null;
        }

        $attributes = collect($validated);

        $user
            ->fill($attributes
                ->only($user->getFillable())
                ->toArray())
            ->save();

        $user->profile
            ->fill($attributes
                ->only($user->profile->getFillable())
                ->toArray())
            ->save();

        return $user;
    }

    /**
     *  Get the validated data from the request.
     *
     *  @param  array|int|string|null  $key
     *  @param  mixed  $default
     *  @return mixed
     */
    public function validated($key = null, $default = null)
    {
        return $this->attribute
            ? [$this->attribute => parent::validated($this->attribute)]
            : parent::validated();
    }
}
