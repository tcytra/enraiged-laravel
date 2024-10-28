<?php

namespace Enraiged\Users\Services;

use Enraiged\Users\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateUserProfile
{
    use Traits\HandlesAddress,
        Traits\HandlesProfile,
        Traits\HandlesUser;

    /** @var  object  The User model. */
    protected User $user;

    /** @var  string|null  The single requested attribute key. */
    protected $attribute;

    /** @var  array  The array of attributes. */
    protected $attributes;

    /**
     *  Create an instance of the UpdateUserProfile service.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  array   $attributes
     *  @param  string|null  $attribute
     *  @return void
     */
    public function __construct(User $user, array $attributes, ?string $attribute = null)
    {
        $this->user = $user;
        $this->attribute = $attribute;
        $this->attributes = $attribute
            ? collect($attributes)
                ->only($attribute)
                ->toArray()
            : Support\UserProfileAttributes::from($attributes, $attribute)
                ->toArray();
    }

    /**
     *  Handle the request to update the user and profile.
     *
     *  @return self
     */
    public function handle(): self
    {
        if ($this->attribute && count($this->attributes) === 1) {
            return $this->singleHandle();
        }

        $transaction = DB::transaction(fn ()
            => $this
                ->handleUser()
                ->handleProfile()
                ->handleAddress());

        //if (!$transaction instanceof self) {} // todo?

        return $this;
    }

    /**
     *  Handle a single attribute User/Profile update.
     *
     *  @return $this
     */
    public function singleHandle(): self
    {
        if ($this->getUserFillable($this->attribute)) {
            $this->user->update($this->attributes);
        } else
        if ($this->getProfileFillable($this->attribute)) {
            $this->user->profile->update($this->attributes);
        }

        return $this;
    }

    /**
     *  Update and return a User from provided attributes.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  array   $attributes
     *  @param  string|null  $attribute
     *  @return \Enraiged\Users\Models\User
     */
    public static function From(User $user, array $attributes, ?string $attribute = null): User
    {
        $handler = (new self($user, $attributes, $attribute))->handle();

        return $handler->user;
    }
}
