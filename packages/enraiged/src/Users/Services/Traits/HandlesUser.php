<?php

namespace Enraiged\Users\Services\Traits;

use Illuminate\Support\Facades\Auth;

trait HandlesUser
{
    /**
     *  Return the user fillable attributes identified by this request.
     *
     *  @param  string|null  $attribute = null
     *  @return array|bool
     */
    public function getUserFillable(?string $attribute = null)
    {
        $fillable = (!Auth::check() && !app()->environment('production')) || (Auth::check() && Auth::user()->isAdministrator)
            ? collect($this->user->getFillable())
                ->merge(['is_hidden', 'is_protected'])
                ->toArray()
            : $this->user->getFillable();

        if ($this->user->exists && $this->user->is_protected) {
            $index = array_search('role_id', $fillable);

            unset($fillable[$index]);
        }

        if ($attribute) {
            return collect($fillable)
                ->contains($attribute);
        }

        return $fillable;
    }

    /**
     *  Return the user fillable attributes provided in this request.
     *
     *  @return array
     */
    public function getUserAttributes(): array
    {
        $fillable = $this->getUserFillable();

        return collect($this->attributes)
            ->only($fillable)
            ->toArray();
    }

    /**
     *  Handle the attributes for the User update.
     *
     *  @return $this
     */
    public function handleUser(): self
    {
        $attributes = $this->getUserAttributes();

        if (count($attributes)) {
            $this->user
                ->fill($attributes)
                ->save();
        }

        return $this;
    }
}
