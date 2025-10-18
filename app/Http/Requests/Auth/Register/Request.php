<?php

namespace App\Http\Requests\Auth\Register;

use Enraiged\Passwords\Rules\PasswordRules;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Request extends FormRequest
{
    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize(): bool
    {
        return config('enraiged.auth.allow_registration') === true;
    }

    /**
     *  Get custom messages for validator errors.
     *
     *  @return array
     */
    #[\Override]
    public function messages()
    {
        $messages = [
            'agreed.accepted' => 'You must agree to check the little box.',
        ];

        if (config('enraiged.auth.allow_secondary_credential') === true) {
            $messages['username.different'] = 'The primary and secondary email addresses must be different.';
        }

        return $messages;
    }

    /**
     *  Create and return the registered User from the provided attributes.
     *
     *  @param  array   $attributes
     *  @return \Illuminate\Foundation\Auth\User
     */
    public function registerUser()
    {
        $validated = $this->validated();

        if (key_exists('name', $validated)) {
            $names = explode(' ', $validated['name']);
            $validated['first_name'] = count($names) ? array_shift($names) : null;
            $validated['last_name'] = count($names) ? implode(' ', $names) : null;
        }

        $attributes = collect($validated);

        $model = config('auth.providers.users.model');

        $profile = new Profile;
        $user = new $model;

        $profile
            ->fill($attributes->only($profile->getFillable())->toArray())
            ->save();

        $attributes['profile_id'] = $profile->id;

        $user
            ->fill($attributes->only($user->getFillable())->toArray())
            ->save();

        return $user;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules(): array
    {
        $user_model = config('auth.providers.users.model');
        $user_table = (new $user_model)->getTable();

        $rules = collect([
                'locale' => 'required|string|min:2|max:2|in:en,es,fr',
                'theme' => 'nullable|array',
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:{$user_table},email",
                'username' => "sometimes|string|max:255|unique:{$user_table},username",
                'password' => ['required', 'confirmed', new PasswordRules],
                'agreed' => 'required|accepted',
            ])
            ->transform(fn ($rule, $key) => 
                $key === 'email'
                    ? $this->transformEmailRule($rule, $user_table)
                    : $rule)
            ->transform(fn ($rule, $key) => 
                $key === 'username'
                    ? $this->transformUsernameRule($user_table)
                    : $rule)
            ->filter(fn ($rule) => $rule !== null)
            ->toArray();

        return $rules;
    }

    /**
     *  Transform the email rule to ensure uniqueness against the username column, if applicable.
     *
     *  @param  string  $rule
     *  @param  string  $table
     *  @return string
     */
    private function transformEmailRule(string $rule, string $table): string
    {
        if (config('enraiged.auth.allow_secondary_credential') === true) {
            return "{$rule}|unique:{$table},username";
        }

        return $rule;
    }

    /**
     *  Add the rules for validating the username, if applicable.
     *
     *  @param  string  $table
     *  @return array|string|null
     */
    private function transformUsernameRule(string $table): array|string|null
    {
        if (config('enraiged.auth.allow_secondary_credential') === true) {
            $rules = 'nullable|string|max:255|different:email';

            if (config('enraiged.auth.allow_username_login') === true) {
                return collect(explode('|', $rules))
                    ->merge([
                        'nullable',
                        'string',
                        'max:255',
                        'different:email',
                        fn ($attribute, $value, $fail)
                            => $this->validateUsernameIsEmailOrAlphaDash($attribute, $value, $fail),
                        "unique:{$table},email",
                        "unique:{$table},username",
                    ])
                    ->toArray();
            }

            return "{$rules}|email|unique:{$table},email|unique:{$table},username";
        }

        return null;
    }

    /**
     *  Validate the username against the alpha_dash and email rules.
     *
     *  @param  string  $attribute
     *  @param  mixed   $value
     *  @param  \Closure $fail
     */
    private function validateUsernameIsEmailOrAlphaDash(string $attribute, mixed $value, \Closure $fail)
    {
        $isAlphaDash = Validator::make([$attribute => $value], [$attribute => 'alpha_dash']);
        $isEmail = Validator::make([$attribute => $value], [$attribute => 'email']);

        if ($isAlphaDash->fails() && $isEmail->fails()) {
            $fail(__('validation.alpha_dash_or_email'));
        }
    }

    /**
     *  Get the validated data from the request.
     *
     *  @param  array|int|string|null  $key
     *  @param  mixed  $default
     *  @return mixed
     */
    #[\Override]
    public function validated($key = null, $default = null)
    {
        return collect(parent::validated($key, $default))
            ->transform(fn ($value, $index)
                => $index === 'password'
                    ? Hash::make($this->get('password'))
                    : $value)
            ->toArray();
    }
}
