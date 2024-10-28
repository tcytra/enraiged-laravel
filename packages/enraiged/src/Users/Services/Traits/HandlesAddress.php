<?php

namespace Enraiged\Users\Services\Traits;

use Enraiged\Addresses\Models\Address;

trait HandlesAddress
{
    /**
     *  Return the address fillable attributes identified by this request.
     *
     *  @param  string|null  $attribute = null
     *  @return array|bool
     */
    public function getAddressFillable(?string $attribute = null)
    {
        $fillable = (new Address)->getFillable();

        if ($attribute) {
            return collect($fillable)
                ->contains($attribute);
        }

        return $fillable;
    }

    /**
     *  Return the address fillable attributes provided in this request.
     *
     *  @return array
     */
    public function getAddressAttributes(): array
    {
        $fillable = $this->getAddressFillable();

        return collect($this->attributes)
            ->only($fillable)
            ->toArray();
    }

    /**
     *  Handle the attributes for the Address update.
     *
     *  @return $this
     */
    public function handleAddress(): self
    {
        $attributes = $this->getAddressAttributes();

        if (count($attributes)) {
            if ($this->user->profile->address) {
                $this->user->profile->address
                    ->update($attributes);

            } else {
                $this->user->profile
                    ->address()
                    ->create($attributes);
            }
        }

        return $this;
    }
}
