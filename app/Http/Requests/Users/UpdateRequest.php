<?php

namespace App\Http\Requests\Users;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Passwords;
use Enraiged\Users\Forms\Validation\Rules;
use Enraiged\Users\Models\User;

class UpdateRequest extends FormRequest
{
    use Messages, Passwords, Rules;

    /**
     *  Return the requested attribute parameter, if exists.
     *
     *  @return string|null
     */
    public function requestedAttribute(): ?string
    {
        return $this->route()->hasParameter('attribute')
            ? str_replace('_', ' ', $this->route()->parameter('attribute'))
            : null;
    }

    /**
     *  Form and return a success message for this request.
     *
     *  @return string
     */
    public function successMessage(): string
    {
        if ($this->route()->hasParameter('attribute')) {
            $attribute = $this->requestedAttribute();

            return ucwords("{$attribute} Updated");
        }

        return 'User Updated';
    }

    /**
     *  Validate the requested attribute exists in the model fillables.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return void
     */
    private function validateAttributeIsFillable($validator)
    {
        $attribute = $this->requestedAttribute();

        $fillable = collect((new User)->getFillable())
            ->merge((new Profile)->getFillable())
            ->except(['created_by', 'deleted_by', 'updated_by']);

        if (!$fillable->contains($attribute)) {
            $validator->errors()->add($attribute, 'This request cannot be processed.');
        }
    }

    /**
     *  Perform additional validation checks.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->route()->hasParameter('attribute')) {
                $this->validateAttributeIsFillable($validator);
            }

            if ($this->filled('password')) {
                (object) $this
                    ->validatePasswordHistory($validator)
                    ->validatePasswordCase($validator)
                    ->validatePasswordLength($validator)
                    ->validatePasswordNumeric($validator)
                    ->validatePasswordSpecial($validator);
            }
        });
    }
}
