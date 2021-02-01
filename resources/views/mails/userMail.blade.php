@component('mail::message')
# Hello {{ $user->name }}

Your account has been created. This is your password: {{ $password }}

@component('mail::button', ['url' => env('APP_URL') . '/login'])
Click here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
