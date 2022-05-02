<?php

namespace App\Http\Requests\Accounts\Profile;

use Enraiged\Accounts\Forms\Validation\Messages;
use Enraiged\Accounts\Forms\Validation\Rules;
use Enraiged\Profiles\Models\Profile;

class UpdateRequest extends EditRequest
{
    use Messages, Rules;

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        $available = (new Profile)->getFillable();

        return collect($this->rules)
            ->only($available)
            ->toArray();
    }
}
