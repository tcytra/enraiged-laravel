<?php

namespace Enraiged\Accounts\Resources;

class AccountManagementResource extends AccountResource
{
    /** @var  array  The array of actions available for this resource. */
    protected $actions = ['avatar.edit', 'login.edit', 'profile.edit'];

    /** @var  bool  Whether or not to include a created_at resource. */
    protected $created = true;

    /** @var  bool  Whether or not to include a updated_at resource. */
    protected $updated = true;
}
