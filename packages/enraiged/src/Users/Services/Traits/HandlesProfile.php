<?php

namespace Enraiged\Users\Services\Traits;

use Enraiged\Profiles\Models\Profile;

trait HandlesProfile
{
    /**
     *  Return the profile fillable attributes identified by this request.
     *
     *  @param  string|null  $attribute = null
     *  @return array|bool
     */
    public function getProfileFillable(?string $attribute = null)
    {
        $fillable = $this->user->profile
            ? $this->user->profile->getFillable()
            : (new Profile)->getFillable();

        if ($attribute) {
            return collect($fillable)
                ->contains($attribute);
        }

        return $fillable;
    }

    /**
     *  Return the profile fillable attributes provided in this request.
     *
     *  @return array
     */
    public function getProfileAttributes(): array
    {
        $fillable = $this->getProfileFillable();

        return collect($this->attributes)
            ->only($fillable)
            ->toArray();
    }

    /**
     *  Handle the attributes for the Profile update.
     *
     *  @return $this
     */
    public function handleProfile(): self
    {
        $attributes = $this->getProfileAttributes();

        if (count($attributes)) {
            if ($this->user->profile) {
                $this->user->profile
                    ->update($attributes);

            } else {
                $profile = Profile::create($attributes);
                $profile->generateAvatar();

                $this->user
                    ->fill(['profile_id' => $profile->id])
                    ->save();

                $this->user->load('profile');
            }
        }

        return $this;
    }
}
