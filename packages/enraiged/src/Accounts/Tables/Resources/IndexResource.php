<?php

namespace Enraiged\Accounts\Tables\Resources;

use App\Http\Requests\Accounts\IndexRequest;
use App\Http\Resources\JsonResource;

class IndexResource extends JsonResource
{
    /** @var  TableRequest  The http request. */
    protected $request;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \App\Http\Requests\Accounts\TableRequest  $request
     *  @return array
     */
    public function toArray($request): array
    {
        if ($request instanceof IndexRequest) {}
        else {
            $request = IndexRequest::createFrom($request);
        }

        $this->request = $request;

        return [
            'id' => $this->id,
            'active' => $this->is_active ? true : false,
            'email' => $this->email,
            'first_name' => $this->profile->first_name,
            'last_name' => $this->profile->last_name,
            'name' => $this->profile->name,
            'username' => $this->username,
            'birthday' => $this->profile->birthdate ? $this->birthday() : null,
            'created' => date('Y-m-d', strtotime($this->created_at)),
            'deleted' => $this->deleted_at ? date('Y-m-d', strtotime($this->deleted_at)) : null,
            'actions' => $request->table()->actionsForRow($this->resource),
        ];
    }

    private function birthday()
    {
        return true // show full birthdate
            ? date('M j Y', strtotime($this->profile->birthdate))
            : date('M j', strtotime($this->profile->birthdate));
    }
}
