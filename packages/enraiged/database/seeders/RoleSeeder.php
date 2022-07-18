<?php

namespace Enraiged\Database\Seeders;

use Enraiged\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $roles = [
        ['name' => 'Administrator', 'rank' => 1, 'text' => 'The top level application role'],
        ['name' => 'Member', 'rank' => 2, 'text' => 'The application membership role'],
    ];

    /**
     *  Seed the application roles.
     *
     *  @return void
     */
    public function run()
    {
        if (key_exists('administrator_role', config('enraiged.auth'))) {
            $this->roles = collect($this->roles)
                ->transform(function ($role) {
                    if ($role['rank'] === 1) {
                        $role['name'] = config('enraiged.auth.administrator_role');
                    }
                    return $role;
                })
                ->toArray();
        }

        foreach ($this->roles as $each) {
            Role::create($each);
        }
    }
}
