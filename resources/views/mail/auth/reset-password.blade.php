<x-mail::message>
# {{ __('Hello :name', ['name' => $user->name]) }}

{{ __('You are receiving this email because we received a password reset request for your account.') }}

<x-mail::button url="{{ $url }}">
{{ __('Reset Password') }}
</x-mail::button>

{{ __('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]) }}

{{ __('If you did not request a password reset, no further action is required.') }}

{{ config('app.name') }}
</x-mail::message>
