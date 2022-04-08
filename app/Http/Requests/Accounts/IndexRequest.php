<?php

namespace App\Http\Requests\Accounts;

use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Resources\Tables\IndexData;
use Enraiged\Accounts\Traits\Tables\Actions as TableActions;
use Enraiged\Accounts\Traits\Tables\Columns as TableColumns;
use Enraiged\Support\Requests\TableRequest;

class IndexRequest extends TableRequest
{
    use TableActions, TableColumns;

    /** @var  string  The uri for the table data request. */
    protected $uri = 'accounts.index.data';

    /**
     *  Return the data for the table request.
     *
     *  @return \Illuminate\Http\Resources\Json\ResourceCollection<\Illuminate\Http\Resources\Json\AnonymousResourceCollection>
     */
    public function data()
    {
        $builder = Account::query()
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->orderBy('profiles.first_name', 'asc')
            ->orderBy('profiles.last_name', 'asc');

        return IndexData::from($builder->get());
    }
}
