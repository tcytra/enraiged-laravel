<?php

namespace Database\Seeders;

use Enraiged\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     *  Seed the application roles.
     *
     *  @return void
     */
    public function run()
    {
        //  be sure to modify this config to suit the project
        $seeds = resource_path('seeds/auth/roles.json');
        $roles = json_decode(file_get_contents($seeds), true);

        if (key_exists('administrator_role', config('enraiged.auth'))) {
            $roles = collect($roles)
                ->transform(function ($role) {
                    if ($role['rank'] === 1) {
                        $role['name'] = config('enraiged.auth.administrator_role');
                    }
                    return $role;
                })
                ->toArray();
        }

        foreach ($roles as $each) {
            Role::create($each);
        }
    }
}
