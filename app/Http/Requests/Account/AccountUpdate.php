<?php

namespace App\Http\Requests\Account;

use App\Auth\Traits\Validators\PasswordValidator;
use App\Http\Requests\FormRequest;

class AccountUpdate extends FormRequest
{
    use PasswordValidator;

    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'email.unique' => 'This email already exists in the system.',
        'password.current' => 'You cannot use the current password.',
        'password.history' => 'You cannot use a recent previous password.',
        'password.length' => 'The password must be at least :number characters.',
        'password.lowercase' => 'There must be at least :number lowercase :plural.',
        'password.numeric' => 'There must be at least :number :plural.',
        'password.special' => 'There must be at least :number special :plural.',
        'password.uppercase' => 'There must be at least :number uppercase :plural.',
    ];

    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Handle the request to create a new User.
     *
     *  @return void
     */
    public function handle(): void
    {
        $this->updateAccount()
            ->updateProfile();
    }

    /**
     *  return instance
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
     *  return instance
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

        return [
            'email' => "required|email|unique:users,email,{$account_id}|unique:users,username,{$account_id}",
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'nullable|confirmed',
            'phone' => 'nullable',
            'salut' => 'nullable',
            'username' => "nullable|email|unique:users,email,{$account_id}|unique:users,username,{$account_id}",
        ];
    }
}
