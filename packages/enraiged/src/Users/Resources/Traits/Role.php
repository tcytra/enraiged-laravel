<?php

namespace Enraiged\Users\Resources\Traits;

use Enraiged\Roles\Resources\RoleResource;

trait Role
{
    /** @var  bool  Whether or not to include the role with this resource. */
    protected bool $with_role = true;

    /**
     *  @return array
     */
    private function role()
    {
        $this->load('role');

        return $this->role
            ? RoleResource::from($this->role)
            : null;
    }

    /**
     *  Ensure the resource includes the role.
     *
     *  @return self
     */
    public function withRole()
    {
        $this->with_role = true;

        return $this;
    }

    /**
     *  Prevent the resource from including the role.
     *
     *  @return self
     */
    public function withoutRole()
    {
        $this->with_role = false;

        return $this;
    }
}
