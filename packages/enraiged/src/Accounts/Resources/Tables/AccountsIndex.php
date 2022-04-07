<?php

namespace Enraiged\Accounts\Resources\Tables;

use Enraiged\Resources\Tables\TableResource;

class AccountsIndex extends TableResource
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
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'name' => $this->profile->name,
            'created' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
    }
}
