<?php

namespace Enraiged\Accounts\Resources\Tables;

use App\Http\Requests\Accounts\IndexRequest;
use Enraiged\Resources\Tables\TableResource;

class IndexData extends TableResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $request = IndexRequest::createFrom($request);

        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->profile->first_name,
            'last_name' => $this->profile->last_name,
            'name' => $this->profile->name,
            'username' => $this->username,
            'birthday' => $this->profile->birthdate ? date('M j', strtotime($this->profile->birthdate)) : null,
            'created' => date('Y-m-d', strtotime($this->created_at)),
            'deleted' => $this->deleted_at ? date('Y-m-d', strtotime($this->deleted_at)) : null,
            'actions' => $request->actions($this->resource),
        ];
    }
}
