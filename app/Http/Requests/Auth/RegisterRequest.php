<?php

namespace App\Http\Requests\Auth;

use App\Auth\User;
use App\Auth\Traits\Validators\PasswordValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    use PasswordValidator;

    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'agree.required' => 'You must agree to check the little box.',
        'email.unique' => 'This email already exists in the system.',
        'password.current' => 'You cannot use the current password.',
        'password.history' => 'You cannot use a recent previous password.',
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
     *  return  \App\Auth\User
     */
    public function handle()
    {
        $user = User::create(
            collect($this->validated())
                ->except(['first_name', 'last_name', 'password_confirm'])
                ->toArray()
        );

        $names = explode(' ', $this->get('first_name'));

        $user->person()->create([
            'first_name' => array_shift($names),
            'last_name' => count($names) ? implode($names) : null,
        ]);

        return $user;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return [
            'agree' => 'required|boolean',
            'email' => 'required|email|unique:users|unique:users,username',
            'first_name' => 'required|string',
            'password' => 'required|string'.config('password.length') ? '|min:'.config('password.length') : '',
        ];
    }

    /**
     *  Configure the validator instance.
     *
     *  @param  \Illuminate\Validation\Validator  $validator
     *  @return void
     */
	public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (true !== $this->get('agree')) {
                $validator->errors()
                    ->add('agree', $this->messages['agree.required']);
            }

            if (Auth::check()) {
                if ($this->user()->currentPasswordIs($this->get('password'))) {
                    $validator->errors()->add('password', $this->messages['password.current']);
                }

                if ($this->passwordHistory()) {
                    $validator->errors()->add('password', $this->messages['password.history']);
                }
            }

            if (!$this->passwordUppercase()) {
                $error = __($this->messages['password.uppercase'], [
                    'number' => config('password.uppercase'),
                    'plural' => config('password.uppercase') > 1 ? 'letters' : 'letter',
                ]);

                $validator->errors()->add('password', $error);
            }

            if (!$this->passwordLowercase()) {
                $error = __($this->messages['password.lowercase'], [
                    'number' => config('password.lowercase'),
                    'plural' => config('password.lowercase') > 1 ? 'letters' : 'letter',
                ]);

                $validator->errors()->add('password', $error);
            }

            if (!$this->passwordNumeric()) {
                $error = __($this->messages['password.numeric'], [
                    'number' => config('password.numeric'),
                    'plural' => config('password.numeric') > 1 ? 'numbers' : 'number',
                ]);

                $validator->errors()->add('password', $error);
            }

            if (!$this->passwordSpecial()) {
                $error = __($this->messages['password.special'], [
                    'number' => config('password.special'),
                    'plural' => config('password.special') > 1 ? 'characters' : 'character',
                ]);

                $validator->errors()->add('password', $error);
            }
        });
    }
}
