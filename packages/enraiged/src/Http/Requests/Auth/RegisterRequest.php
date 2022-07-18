<?php

namespace Enraiged\Http\Requests\Auth;

use App\Auth\Traits\Validators\PasswordValidator;
use App\Auth\User;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Forms\Validation\Messages as ValidationMessages;
use Enraiged\Accounts\Forms\Validation\Rules as ValidationRules;
use Enraiged\Accounts\Services\CreateAccount;
use Enraiged\Forms\Requests\FormRequest;

class RegisterRequest extends FormRequest
{
    use PasswordValidator, ValidationMessages, ValidationRules;

    /** @var  object  The created Account. */
    protected $account;

    /**
     *  Return the created Account.
     *
     *  @return \Enraiged\Accounts\Models\Account
     */
    public function account(): Account
    {
        return $this->account;
    }

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
     *  @return void
     */
    public function handle(): void
    {
        $this->account = CreateAccount::from($this->validated());
        $user = $this->account->user;

        if ($user->mustAgreeToTerms && !$user->hasAgreedToTerms) {
            $user->acceptAgreements();
        }
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
     *  Get the user making the request.
     *
     *  @param  string|null  $guard
     *  @return mixed
     */
    public function user($guard = null)
    {
        return $guard || !$this->account
            ? parent::user()
            : $this->account->user;
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
