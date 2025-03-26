<x-mail::message>
# {{ __('Hello :name', ['name' => $user->name]) }}

{{ __('Please click the button below to verify your secondary email address.') }}

<x-mail::button url="{{ $url }}">
{{ __('Verify Secondary Email Address') }}
</x-mail::button>

{{ __('If you did not create an account, no further action is required.') }}

{{ config('app.name') }}
</x-mail::message>
