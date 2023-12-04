<?php

namespace App\Http\Requests\Auth;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Validation\Messages as ValidationMessages;
use Enraiged\Users\Forms\Validation\Passwords as ValidationPassword;
use Enraiged\Users\Forms\Validation\Rules as ValidationRules;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\CreateUserProfile;

class RegisterRequest extends FormRequest
{
    use ValidationMessages, ValidationPassword, ValidationRules;

    /**
     *  Return boolean true if the user has agreed.
     *
     *  @return bool
     */
    public function agreed(): bool
    {
        return $this->get('agree') === true;
    }

    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return config('enraiged.auth.allow_registration') === true;
    }

    /**
     *  Handle the request to create a new User.
     *
     *  @return \Enraiged\Users\Models\User
     */
    public function handle(): User
    {
        $user = CreateUserProfile::from($this->validated());

        if ($user->mustAgreeToTerms && !$user->hasAgreedToTerms) {
            $user->acceptAgreements();
        }

        return $user;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        $rules = collect($this->rules)
            ->except(['birthday', 'first_name', 'gender', 'last_name', 'salut', 'timezone', 'title'])
            ->merge(['name' => 'required'])
            ->merge(['password' => 'required|confirmed']);

        return (new User)->mustAgreeToTerms
            ? $rules->merge(['agree' => 'required|boolean'])->toArray()
            : $rules->toArray();
    }

    /**
     *  Validate that the user has agreed to required terms.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return void
     */
    public function withValidator($validator)
	{
        if ((new User)->mustAgreeToTerms) {
            $validator->after(function ($validator) {
                if (!$this->agreed()) {
                    $validator->errors()->add('agree', $this->messages['agree.required']);
                }
            });
        }
	}
}
