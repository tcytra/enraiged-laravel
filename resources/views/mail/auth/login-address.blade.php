<x-mail::message>
# {{ __('Hello :name', ['name' => $user->name]) }}

{{ __('There has just been a login to your account from a new device or ip address.') }}

{{ __('The ip address is: :address', ['address' => $address->ip_address]) }}

{{ __('The login credential is: :credential', ['credential' => $address->credential]) }}

{{ __('If this login is unexpected, please take immediate action to protect your account by changing your password.') }}

{{ __('Feel free to contact the support team if you have questions or require assistance.') }}

{{ config('app.name') }}
</x-mail::message>
