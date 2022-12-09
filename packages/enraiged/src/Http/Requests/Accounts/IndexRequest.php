<?php

namespace Enraiged\Http\Requests\Accounts;

use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Tables\Builders\AccountsIndex;
use Enraiged\Tables\Contracts\ProvidesTableBuilder;
use Enraiged\Tables\Requests\TableRequest;

class IndexRequest extends TableRequest implements ProvidesTableBuilder
{
    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return $this->user()->can('index', Account::class);
    }

    /**
     *  Create and return a TableBuilder from the current Request.
     *
     *  @return \Enraiged\Tables\Builders\AccountsIndex
     */
    public function table()
    {
        if (!$this->table) {
            $this->table = AccountsIndex::from($this);
        }

        return $this->table;
    }
}
