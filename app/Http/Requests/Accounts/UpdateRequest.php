<?php

namespace App\Http\Requests\Accounts;

use App\Auth\Traits\Validators\PasswordValidator;
use Enraiged\Accounts\Traits\Validation\Messages as ValidationMessages;
use Enraiged\Accounts\Traits\Validation\Rules as ValidationRules;
use Enraiged\Support\Requests\FormRequest;

class UpdateRequest extends FormRequest
{
    use PasswordValidator, ValidationMessages, ValidationRules;

    /**
     *  Handle the request to create a new User.
     *
     *  @return void
     */
    public function handle(): void
    {
        $this->updateAccount()
            ->updateProfile();

        $this->session()
            ->put('success', 'Update successful');
    }

    /**
     *  @return $this
     */
    protected function updateAccount()
    {
        $parameters = collect($this->validated())
            ->only(['email', 'username']);

        if ($this->filled('password')) {
            $parameters->merge(['password' => $this->get('password')]);
        }

        $this->route('account')
            ->fill($parameters->toArray())
            ->save();

        return $this;
    }

    /**
     *  @return $this
     */
    protected function updateProfile()
    {
        $parameters = collect($this->validated())
            ->only(['first_name', 'last_name', 'phone', 'salut'])
            ->toArray();

        $this->route('account')->profile
            ->fill($parameters)
            ->save();

        return $this;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        $account_id = $this->route('account')->id;

        $rules = [
            'email' => "required|email|unique:users,email,{$account_id}|unique:users,username,{$account_id}",
            'password' => 'nullable|confirmed',
            'username' => "nullable|email|unique:users,email,{$account_id}|unique:users,username,{$account_id}",
        ];

        return collect($this->rules)
            ->merge($rules)
            ->toArray();
    }
}
