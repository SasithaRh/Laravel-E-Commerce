@component('vendor.mail.html.message')
Hi <b>{{ $Order->first_name }}</b>

Order Details :

<li>
    Order No : {{ $Order->id }}
</li>
<li>
    Date of Purchase : {{ $Order->created_at }}
</li>


@endcomponent


