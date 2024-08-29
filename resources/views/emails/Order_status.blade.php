@component('vendor.mail.html.message')
Hi <b>{{ $details->first_name }}</b>

Order is :@if ( $details->status == 0)
    Pending
    @elseif ( $details->status == 1)
    Inprogress
    @elseif ( $details->status == 2)
    Delivered
    @elseif ( $details->status == 3)
    Completed
    @elseif ( $details->status == 4)
    Cancelled
@endif

<li>
    Order No : {{ $details->id }}
</li>
<li>
    Date of Purchase : {{ $details->created_at }}
</li>


@endcomponent


