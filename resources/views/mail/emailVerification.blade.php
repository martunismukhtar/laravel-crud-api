
 @component('mail::message')
<h1>Dear {{ $name }},</h1>

<br/>
Please click the button below to verify your email address.

@component('mail::button', ['url'=>$verification_link])
Verify Email Address
@endcomponent

<br>
{{ config('app.name') }}

@component('mail::subcopy')
If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: {!! $verification_link !!}
@endcomponent
@endcomponent


