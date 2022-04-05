<?php

namespace App\Account\Resources;

use App\Account\Enums\Saluts;
use App\Http\Resources\JsonResource;

class AccountFormBuilder extends JsonResource
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
                'clear' => 'Clear', 'reset' => 'Reset', 'submit' => 'Submit',
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
                'uri' => route('account.update', ['account' => $this->id], false),
            ],
        ];
    }

    private function saluts()
    {
        return Saluts::collection()
            ->transform(function($item, $key){
                return ['name' => $item, 'code' => $item];
            })
            ->values();
    }
}
