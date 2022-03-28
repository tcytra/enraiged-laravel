<?php

namespace App\Http\Requests\Auth;

use App\Account\Profile;
use App\Auth\Traits\Validators\PasswordValidator;
use App\Auth\User;
use App\Http\Requests\FormRequest;
use Illuminate\Auth\Events\Registered;

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

    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'agree' => 'required|boolean',
        'email' => 'required|email|unique:users|unique:users,username',
        'first_name' => 'required',
        'password' => 'required|confirmed',
    ];

    /** @var  object  The created account User. */
    public $user;

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
        $names = explode(' ', $this->get('first_name'));

        $profile = Profile::create([
            'first_name' => array_shift($names),
            'last_name' => count($names) ? implode($names) : null,
        ]);

        $this->user = User::create(
            collect($this->validated())
                ->except(['first_name', 'last_name', 'password_confirmation'])
                ->merge(['profile_id' => $profile->id])
                ->toArray()
        );

        event(new Registered($this->user));
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return collect($this->rules)
            ->merge([
                    'password' => 'required|confirmed'
                        .config('password.length')
                            ? '|min:'.config('password.length')
                            : ''
                ])
            ->toArray();
    }
}
