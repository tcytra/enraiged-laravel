<?php

namespace App\Packages\Users\Enums;

use Enraiged\Enums\Traits\StaticMethods;
use Enraiged\Users\Enums\Traits\RoleMethods;

enum Roles: string
{
    use RoleMethods, StaticMethods;

    case Administrator = 'Application Administrator';
    case Manager = 'Systems Manager';
    case Member = 'Member Account';

    /**
     *  Return a selectable array of enumerated options.
     *
     *  @return array
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->transform(fn ($option)
                => collect($option->role())
                    ->only(['id', 'name']))
            ->toArray();
    }

    /**
     *  Return the expanded attributes of a role.
     *
     *  @return object
     */
    public function role(): object
    {
        return (object) match($this) {
            Roles::Administrator => $this->attributes(Roles::Administrator, 1),
            Roles::Manager => $this->attributes(Roles::Manager, 2),
            Roles::Member => $this->attributes(Roles::Member, 3),
        };
    }
}
