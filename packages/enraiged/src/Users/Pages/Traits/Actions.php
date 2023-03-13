<?php

namespace Enraiged\Users\Pages\Traits;

use Enraiged\Users\Models\User;

trait Actions
{
    /**
     *  Prepare and return the available users page actions.
     *
     *  @return array
     */
    private function actions(User $user)
    {
        $parameters = ['user' => $user->id];

        return [
            'avatar' => [
                'class' => 'p-button-info p-button-text',
                'icon' => 'pi pi-circle',
                'label' => 'Avatar',
                'uri' => $user->isMyself
                    ? route('my.avatar')
                    : route('users.avatar.edit', $parameters),
            ],
            'show' => [
                'class' => 'p-button-info p-button-text',
                'icon' => 'pi pi-user',
                'label' => 'Profile',
                'uri' => $user->isMyself
                    ? route('my.profile', [])
                    : route('users.profile.show', $parameters),
            ],
            'edit' => [
                'class' => 'p-button-info p-button-text',
                'icon' => 'pi pi-pencil',
                'label' => 'Edit',
                'uri' => $user->isMyself
                    ? route('my.details', [])
                    : route('users.profile.edit', $parameters),
            ],
            'login' => [
                'class' => 'p-button-info p-button-text',
                'icon' => 'pi pi-sign-in',
                'label' => 'Login',
                'uri' => $user->isMyself
                    ? route('my.login', [])
                    : route('users.login.edit', $parameters),
            ],
            'settings' => [
                'class' => 'p-button-info p-button-text',
                'icon' => 'pi pi-cog',
                'label' => 'Settings',
                'uri' => $user->isMyself
                    ? route('my.settings', [])
                    : route('users.settings.edit', $parameters),
            ],
        ];
    }
}
