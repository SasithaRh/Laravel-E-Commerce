@component('vendor.mail.html.message')
Hi <b>{{ $user->name }}</b>

Simply verify your email address , Please click on button.

@component('mail::button',['url'=>url('activate/'.base64_encode($user->id))])
Verify

@endcomponent

@endcomponent
