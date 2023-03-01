<x-mail::message>
# {{ __('Hello :name', ['name' => $user->profile->first_name]) }}

{{ __('Welcome to :app!', ['app' => config('app.name')]) }}

<x-mail::button url="{{ route('dashboard') }}">
{{ __('View My Dashboard') }}
</x-mail::button>

{{ __('Feel free to contact the support team if you have questions or require assistance.') }}

{{ config('app.name') }}
</x-mail::message>
