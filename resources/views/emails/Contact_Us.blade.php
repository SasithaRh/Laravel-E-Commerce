@component('vendor.mail.html.message')
Hi <b>{{ $user->cname }}</b>

Your Message has been saved successfully !

<li>
    Phone No : {{ $user->cphone }}
</li>
<li>
    Subject : {{ $user->csubject }}
</li>
<li>
    Subject : {{ $user->cmessage }}
</li>


@endcomponent


