<?php

namespace Enraiged\Users\Resources\Traits;

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
        $parameters = ['user' => $this->id];

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
                : route('users.avatar.edit', $parameters, $full_url),
        ];
    }

    /**
     *  @return array
     */
    private function actionDetailsEdit($full_url, $parameters)
    {
        return [
            'class' => 'p-button-info p-button-text',
            'icon' => 'pi pi-user',
            'label' => 'Details',
            'uri' => $this->is_myself
                ? route('my.profile', [], $full_url)
                : route('users.profile.edit', $parameters, $full_url),
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
                : route('users.login.edit', $parameters, $full_url),
        ];
    }

    /**
     *  @return array
     */
    private function actionSettingsEdit($full_url, $parameters)
    {
        return [
            'class' => 'p-button-info p-button-text',
            'icon' => 'pi pi-cog',
            'label' => 'Settings',
            'uri' => $this->is_myself
                ? route('my.settings', [], $full_url)
                : route('users.settings.edit', $parameters, $full_url),
        ];
    }
}
