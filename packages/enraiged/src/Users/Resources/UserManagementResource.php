<?php

namespace Enraiged\Users\Resources;

class UserManagementResource extends UserResource
{
    /** @var  array  The array of actions available for this resource. */
    protected $actions = ['avatar.edit', 'details.edit', 'login.edit', 'settings.edit'];

    /** @var  bool  Whether or not to include a created_at resource. */
    protected $created = true;

    /** @var  bool  Whether or not to include a updated_at resource. */
    protected $updated = true;
}
