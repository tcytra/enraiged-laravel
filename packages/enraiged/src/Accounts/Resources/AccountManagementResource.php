<?php

namespace Enraiged\Accounts\Resources;

class AccountManagementResource extends AccountResource
{
    /** @var  bool  Whether or not to include a created_at resource. */
    protected $created = true;

    /** @var  bool  Whether or not to include a updated_at resource. */
    protected $updated = true;
}
