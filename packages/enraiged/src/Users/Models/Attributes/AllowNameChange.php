<?php

namespace Enraiged\Users\Models\Attributes;

trait AllowNameChange
{
    /**
     *  @return bool
     */
    public function getAllowNameChangeAttribute(): bool
    {
        $config = json_decode(json_encode( config('enraiged.auth.allow_name_change') ));
        $default = true;

        if ($config === false || $config === true) {
            return $config;
        }

        if (!$config || !$this->isMyself) {
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

        if (property_exists($config, 'ignore_roles')
                && collect($config->ignore_roles)
                    ->contains($this->role->name)) {
            return $default;
        }

        if (property_exists($config, 'until_expire')) {
            return timestamp($this->created_at) > timestamp($config->until_expire);
        }

        return $default;
    }

    /**
     *  @return bool
     */
    public function getDisableNameChangeAttribute(): bool
    {
        return $this->allow_name_change === false;
    }
}
