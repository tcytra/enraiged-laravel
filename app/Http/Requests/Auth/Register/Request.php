<?php

namespace App\Http\Requests\Auth\Register;

use Enraiged\Passwords\Rules\PasswordRules;
use Illuminate\Foundation\Http\FormRequest;
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
        if (config('enraiged.auth.allow_secondary_credential') === true) {
            return [
                'username.different' => 'The primary and secondary email addresses must be different.',
            ];
        }

        return [];
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user_model = config('auth.providers.users.model');
        $user_table = (new $user_model)->getTable();

        $rules = collect([
                'locale' => 'required|string|min:2|max:2|in:en,es,fr',
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:{$user_table},email",
                'username' => null,
                'password' => ['required', 'confirmed', new PasswordRules],
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
}
