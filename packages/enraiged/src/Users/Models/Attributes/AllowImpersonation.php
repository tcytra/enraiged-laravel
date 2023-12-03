<?php

namespace Enraiged\Users\Models\Attributes;

use App\Enums\Roles;

trait AllowImpersonation
{
    /**
     *  @return bool
     */
    public function getAllowImpersonationAttribute(): bool
    {
        $config = obj(config('enraiged.auth.allow_impersonation'));
        $default = $this->role->is(Roles::Administrator);

        if ($config === false || $config === true) {
            return $config && $default;
        }

        if (!$config) {
            return $default;
        }

        if (property_exists($config, 'except_roles')) {
            return collect($config->except_roles)
                ->doesntContain($this->role->name);
        }

        if (property_exists($config, 'only_roles')) {
            return collect($config->only_roles)
                ->contains($this->role->name);
        }

        return $default;
    }

    /**
     *  Determine whether this user can impersonate another user.
     *
     *  @param  \Illuminate\Foundation\Auth\User  $user
     *  @return bool
     */
    public function canImpersonate($user): bool
    {
        authenticable_check($user);

        if (!$this->allow_impersonation) {
            return false;
        }

        $config_exists = key_exists('allow_impersonation', config('enraiged.auth'))
            && gettype(config('enraiged.auth.allow_impersonation')) === 'array';

        if ($config_exists) {
            $config = config('enraiged.auth.allow_impersonation');

            $allow_impersonate_administrator = key_exists('impersonate_administrator', $config)
                && $config['impersonate_administrator'] === true;

            if (!$allow_impersonate_administrator && $user->role->is(Roles::Administrator)) {
                return false;
            }

            $allow_elevated_roles = key_exists('elevated_roles', $config)
                && $config['elevated_roles'] === true;

            if (!$allow_elevated_roles && $user->outranks($this)) {
                return false;
            }

            return true;
        }

        return !$user->outranks($this);
    }
}
