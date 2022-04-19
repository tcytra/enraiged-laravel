<?php

namespace Enraiged\Tables\Requests;

use Illuminate\Http\Request;

class TableRequest extends Request
{
    /** @var  object  The table builder. */
    protected $table;

    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return true;
    }
}
