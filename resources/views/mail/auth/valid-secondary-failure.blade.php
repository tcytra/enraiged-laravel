<x-mail::message>
# {{ __('Hello :name', ['name' => $user->name]) }}

{{ __('A recent attempt to log in with your secondary email address has failed.') }}

{{ __('This email address must be validated before a log in will succeed.') }}

{{ __('Please log in with your primary email address and navigate to your profile to send a new verification email.') }}

{{ config('app.name') }}
</x-mail::message>
