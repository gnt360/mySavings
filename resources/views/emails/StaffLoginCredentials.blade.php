@component('mail::message')
    # Introduction

    Dear, {{ $user->user_name }},
    Here is your secret login Credentials:
    Username: {{ $user->email }}
    Password: {{ $password }}
    Kindly, change your password later

    @component('mail::button', ['url' => ''])
        Login Here
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
