<?php

namespace App\Enums;

use Enraiged\Enums\Traits\StaticMethods;

enum Roles: string
{
    use StaticMethods;

    case Administrator = 'Administrator';
    case Member = 'Member';

    /**
     *  Determine if this role is greater than or equal to a provided role.
     *
     *  @param  \App\Enums\Roles  $role
     *  @return bool
     */
    public function atLeast($role): bool
    {
        return $this->role()->rank === $role->role()->rank;
    }

    /**
     *  Find and return a role by id, if possible.
     *
     *  @param  int     $search
     *  @return self
     */
    public static function find($search): self
    {
        foreach (Roles::cases() as $each) {
            $role = $each->role();

            if ((preg_match('/^\d+$/', $search) && $role->id == $search)
                || (gettype($search) === 'string' && $role->name == $search)) {
                return $each;
            }
        }

        return null;
    }

    /**
     *  Return an array of role ids.
     *
     *  @return array
     */
    public static function ids(): array
    {
        return collect(self::options())
            ->transform(fn ($option) => $option->id)
            ->values()
            ->toArray();
    }

    /**
     *  Determine if this role matches a provided role.
     *
     *  @param  \App\Enums\Roles  $role
     *  @return bool
     */
    public function is($role): bool
    {
        return $this === $role;
    }

    /**
     *  Determine if this role does not match a provided role.
     *
     *  @param  \App\Enums\Roles  $role
     *  @return bool
     */
    public function isNot($role): bool
    {
        return $this !== $role;
    }

    /**
     *  Return a selectable array of enumerated options.
     *
     *  @return array
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->transform(fn ($option)
                => $option->role())
            ->toArray();
    }

    /**
     *  Return the attributes of a role.
     *
     *  @return object
     */
    public function role(): object
    {
        return (object) match($this) {
            Roles::Administrator => [
                'id' => 1,
                'rank' => 1,
                'name' => Roles::Administrator->value,
            ],
            Roles::Member => [
                'id' => 2,
                'rank' => 2,
                'name' => Roles::Member->value,
            ],
        };
    }
}
