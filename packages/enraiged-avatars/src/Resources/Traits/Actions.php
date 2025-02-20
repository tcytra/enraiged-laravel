<?php

namespace Enraiged\Avatars\Resources\Traits;

trait Actions
{
    /**
     *  Provide the available avatar actions.
     *
     *  @return array
     */
    protected function actions(): array
    {
        $parameters = ['avatar' => $this->id];

        return [
            'delete' => [
                'method' => 'delete',
                'uri' => route('avatars.delete', $parameters),
            ],
            'update' => [
                'method' => 'patch',
                'uri' => route('avatars.update', $parameters),
            ],
            'upload' => [
                'method' => 'post',
                'uri' => route('avatars.upload', $parameters),
            ],
        ];
    }
}
