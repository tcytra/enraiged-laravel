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
     *
     *  @todo:  The $request provided here is \Illuminate\Http\Request, not IndexRequest
     *  @see:   https://stackoverflow.com/questions/54768010/how-to-pass-custom-request-to-api-resource
     */
    public function toArray($request): array
    {
        $request = IndexRequest::createFrom($request);

        return [
            'id' => $this->id,
            'name' => $this->profile->name,
            'email' => $this->email,
            'username' => $this->username,
            'created' => date('Y-m-d', strtotime($this->created_at)),
            'deleted' => $this->deleted_at ? date('Y-m-d', strtotime($this->deleted_at)) : null,
        ];
    }
}
