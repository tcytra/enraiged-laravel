<x-mail::message>
# {{ __('Hello :name', ['name' => $user->name]) }}

{{ __('There have been changes to your account login.') }}

{{ __('If this update is unexpected, please take immediate action to protect your account by changing your password.') }}

{{ __('Feel free to contact the support team if you have questions or require assistance.') }}

{{ config('app.name') }}
</x-mail::message>
