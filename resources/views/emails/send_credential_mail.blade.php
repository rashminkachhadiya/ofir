@component('mail::message')
# {{ __('Hello, :name', ['name' => $mailInfo->f_name]) }}

{{ __('Your account has been created. Here are your login credentials:') }}

@component('mail::panel')
**{{ __('Username') }}:** {{ $mailInfo->username }}

**{{ __('Password') }}:** {{ $mailInfo->password }}
@endcomponent

{{ __('Please log in and change your password after your first sign in.') }}

{{ __('Thanks') }},<br>
{{ config('app.name', 'LEBAR') }}
@endcomponent
