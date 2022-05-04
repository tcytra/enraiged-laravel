<?php

namespace Enraiged\Accounts\Resources\Traits;

use Illuminate\Support\Str;

trait Actions
{
    /**
     *  Assemble and return the available page actions.
     *
     *  @return array
     */
    private function actions()
    {
        $actions = [];
        $full_url = false;
        $parameters = ['account' => $this->id];

        foreach ($this->actions as $each) {
            $method = Str::camel('action-'.str_replace('.', '-', $each));

            if (method_exists($this, $method)) {
                $actions[$each] = $this->{$method}($full_url, $parameters);
            }
        }

        return $actions;
    }

    /**
     *  @return array
     */
    private function actionAvatarEdit($full_url, $parameters)
    {
        return [
            'class' => 'p-button-info p-button-text',
            'icon' => 'pi pi-circle',
            'label' => 'Avatar',
            'uri' => $this->is_myself
                ? route('my.avatar', [], $full_url)
                : route('accounts.avatar.edit', $parameters, $full_url),
        ];
    }

    /**
     *  @return array
     */
    private function actionLoginEdit($full_url, $parameters)
    {
        return [
            'class' => 'p-button-info p-button-text',
            'icon' => 'pi pi-sign-in',
            'label' => 'Login',
            'uri' => $this->is_myself
                ? route('my.login', [], $full_url)
                : route('accounts.login.edit', $parameters, $full_url),
        ];
    }

    /**
     *  @return array
     */
    private function actionProfileEdit($full_url, $parameters)
    {
        return [
            'class' => 'p-button-info p-button-text',
            'icon' => 'pi pi-user',
            'label' => 'Profile',
            'uri' => $this->is_myself
                ? route('my.profile', [], $full_url)
                : route('accounts.profile.edit', $parameters, $full_url),
        ];
    }
}
