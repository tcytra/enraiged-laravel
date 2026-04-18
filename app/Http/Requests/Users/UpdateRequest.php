<?php

namespace App\Http\Requests\Users;

use App\Packages\Users\Forms\Validation\Messages;
use App\Packages\Users\Forms\Validation\Rules;
use Enraiged\Geo\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class UpdateRequest extends FormRequest
{
    use Messages, Rules;

    /**
     *  Update and return the User with the requested attributes.
     *
     *  @param  \App\Packages\Users\Models\User
     *  @return \App\Packages\Users\Models\User
     */
    public function updateUser($user)
    {
        $validated = $this->validated();

        if (key_exists('name', $validated)) {
            $names = explode(' ', $validated['name']);
            $validated['first_name'] = count($names) ? array_shift($names) : null;
            $validated['last_name'] = count($names) ? implode(' ', $names) : null;
        }

        return DB::transaction(function () use ($user, $validated) {
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

            $address_attributes = $attributes
                ->only((new Address)->getFillable());

            if ($address_attributes->filter(fn ($value) => !is_null($value))->count()) {
                if ($user->profile->address) {
                    $user->profile->address
                        ->fill($address_attributes->toArray())
                        ->save();

                } else {
                    $user->profile->address()
                        ->create($address_attributes->toArray());
                }
            }

            return $user;
        });
    }

    /**
     *  Get the validated data from the request.
     *
     *  @param  array|int|string|null  $key
     *  @param  mixed  $default
     *  @return mixed
     */
    #[\Override]
    public function validated($key = null, $default = null)
    {
        return $this->attribute
            ? [$this->attribute => parent::validated($this->attribute, $default)]
            : parent::validated($key, $default);
    }
}
