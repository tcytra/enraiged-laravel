<?php

namespace App\Http\Requests\Auth;

use App\Auth\Traits\Validators\PasswordValidator;
use Enraiged\Accounts\Events\AccountCreated;
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
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return config('auth.allow_registration') === true;
    }

    /**
     *  Handle the request to create a new User.
     *
     *  @return void
     */
    public function handle(): void
    {
        $this->account = CreateAccount::from($this->validated());

        event(new AccountCreated($this->account));
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        $rules = [
            'agree' => 'required|boolean',
            'name' => 'required',
            'password' => 'required|confirmed',
        ];

        return collect($this->rules)
            ->except(['birthday', 'first_name', 'gender', 'last_name', 'salut', 'timezone', 'title'])
            ->merge($rules)
            ->toArray();
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
}
