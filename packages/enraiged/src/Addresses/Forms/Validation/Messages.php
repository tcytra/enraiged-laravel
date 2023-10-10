<?php

namespace Enraiged\Addresses\Forms\Validation;

trait Messages
{
    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'city.required' => 'The name of the city is required.',
        'country_id' => 'A selected country is required.',
        'postal.required' => 'A zip/postal code is required.',
        'region_id' => 'A selected state/province is required.',
        'street.required' => 'The street address is required.',
    ];

    /**
     *  Get the validation messages that apply to the request.
     *
     *  @return array
     */
    public function messages()
    {
        return $this->messages;
    }
}
