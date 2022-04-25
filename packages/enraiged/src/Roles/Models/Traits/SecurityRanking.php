<?php

namespace Enraiged\Roles\Models\Traits;

use Enraiged\Roles\Models\Role;

trait SecurityRanking
{
    /**
     *  Determine if the role ranks at least as high as a provided role definition.
     *
     *  @param  mixed   $role  A role model, id, or name.
     *  @return bool
     */
    public function atLeast($role): bool
    {
        if (gettype($role) === 'object' && $role instanceof Role) {
            $role = $role->name;
        }

        $match = preg_match("/^\d+$/", $role) ? 'id' : 'name';
        $model = Role::where($match, $role)
            ->orderBy('rank')
            ->first();

        return $model && $model->rank >= $this->rank;
    }

    /**
     *  Determine if the role matches a provided role definition.
     *
     *  @param  mixed   $role  A role model, id, or name; Or, an array containing these.
     *  @return bool
     */
    public function is($role): bool
    {
        if (is_array($role)) {
            foreach ($role as $each) {
                if ($this->is($each)) {
                    return true;
                }
            }

        } else {
            if (gettype($role) === 'object' && $role instanceof Role) {
                $role = $role->name;
            }

            $match	= preg_match("/^\d+$/", $role) ? 'id' : 'name';
            $role	= ($match === 'name') ? ucwords($role) : $role;

            return $this->{$match} === $role;
        }

        return false;
    }

    /**
     *  Determine if the role does not match a provided role definition.
     *
     *  @param  mixed   A role model, id, or name; Or, an array containing these.
     *  @return bool
     */
    public function isNot($role): bool
    {
        if (is_array($role)) {
            foreach ($role as $each) {
                $has_role = false;

                if ($this->is($each)) {
                    $has_role = true;
                }

                return !$has_role;
            }

        } else {
            return !$this->is($role);
        }
    }
}
