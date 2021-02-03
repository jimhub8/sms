@component('mail::message')
# Hello {{ $agent->name }}

Your account has been created. This is your password: {{ $password }}

@component('mail::button', ['url' => env('APP_URL') . '/agent/login'])
Click here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
