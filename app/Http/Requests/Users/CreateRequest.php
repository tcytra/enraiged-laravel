<?php

namespace App\Http\Requests\Users;

use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    use Messages, Rules;

    /**
     *  Create and return a User with the requested attributes.
     *
     *  @param  \Enraiged\Users\Models\User
     *  @return \Enraiged\Users\Models\User
     */
    public function createUser($user)
    {
        $validated = $this->validated();

        if (key_exists('name', $validated)) {
            $names = explode(' ', $validated['name']);
            $validated['first_name'] = count($names) ? array_shift($names) : null;
            $validated['last_name'] = count($names) ? implode(' ', $names) : null;
        }

        $attributes = collect($validated);

        $profile = Profile::create(
            $attributes
                ->only((new Profile)->getFillable())
                ->toArray()
        );

        $user
            ->fill($attributes
                ->only($user->getFillable())
                ->merge(['profile_id' => $profile->id])
                ->toArray())
            ->save();

        return $user;
    }
}
