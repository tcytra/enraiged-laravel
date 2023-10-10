<?php

namespace Enraiged\Users\Models\Relations;

use Enraiged\Users\Models\InternetAddress;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyInternetAddresses
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipAddresses(): HasMany
    {
        return $this->hasMany(InternetAddress::class, 'user_id');
    }

    /**
     *  Create or update an ip address record for the authenticated user.
     *
     *  @param  string  $address
     *  @return void
     */
    public function trackIp($address)
    {
        $address_record = $this->ipAddresses()
            ->where('ip_address', ip_to_binary($address))
            ->first();

        if ($address_record) {
            $address_record->touch();
        } else {
            $this->ipAddresses()->create(['ip_address' => $address]);
        }
    }
}
