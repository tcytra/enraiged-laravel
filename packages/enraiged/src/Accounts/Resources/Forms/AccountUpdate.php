<?php

namespace Enraiged\Accounts\Resources\Forms;

use Enraiged\Profiles\Enums\Saluts;
use Enraiged\Resources\Forms\FormResource;

class AccountUpdate extends FormResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        return [
            'actions' => [
                'clear' => 'Clear',
                'reset' => 'Reset',
                'submit' => 'Submit',
            ],
            'fields' => [
                'email' => $this->email,
                'first_name' => $this->profile->first_name,
                'last_name' => $this->profile->last_name,
                'password' => null,
                'password_confirmation' => null,
                'phone' => $this->profile->phone,
                'salut' => $this->profile->salut,
                'username' => $this->username,
            ],
            'options' => [
                'salut' => $this->saluts(),
            ],
            'resource' => [
                'id' => $this->id,
                'method' => 'patch',
                'uri' => route('accounts.update', ['account' => $this->id], false),
            ],
        ];
    }

    /**
     *  Transform the resource collection into an array.
     *
     *  @return array
     */
    private function saluts()
    {
        return Saluts::collection()
            ->transform(function($item, $key){
                return ['name' => $item, 'code' => $item];
            })
            ->values()
            ->toArray();
    }
}
