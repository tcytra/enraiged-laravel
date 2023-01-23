<?php

namespace Enraiged\Avatars\Traits\Validators;

trait AvatarColorValidator
{
    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'color.valid' => 'This is not a valid color index.',
    ];

    /**
     *  Configure the validator instance.
     *
     *  @param  \Illuminate\Validation\Validator  $validator
     *  @return void
     *  @todo   A means of appying a min/max to the ui color picker and validate here.
     *
	public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $color_index = hexdec($this->get('color'));

            if (!$this->indexWithinRange($color_index)) {
                $error = __($this->messages['color.valid']);
                $validator->errors()->add('color', $error);
            }
        });
    }*/

    /**
     *  Determine if the provided color is within range
     *
     *  @param  int     $color_index
     *  @return bool
     */
    protected function indexWithinRange($color_index): bool
    {
        $color_index = hexdec($this->get('color'));
        $maximum_index = config('enraiged.avatars.color.maximum');
        $minimum_index = config('enraiged.avatars.color.minimum');

        return $color_index <= $maximum_index
            && $color_index >= $minimum_index;
    }
}
