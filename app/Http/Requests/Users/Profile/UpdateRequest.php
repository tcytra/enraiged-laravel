<?php

namespace App\Http\Requests\Users\Profile;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Rules;

class UpdateRequest extends FormRequest
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
