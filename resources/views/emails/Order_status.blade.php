
@component('vendor.mail.html.message')

<p>Dear {{ $details->first_name }},</p>
Your Order is :@if ( $details->status == 0)
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
<h3>Order Details:</h3>
<ul>
<li>Order Number: {{ $details->id }}</li>
 <li>Date of Purchase: {{ $details->created_at }}</li>
</ul>
<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
<thead>
<tr>
<th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Item</th>
<th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Quantity</th>
<th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Price</th>
</tr>
</thead>
<tbody>
@foreach ($details->getItem as $item)
<tr>
<td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->getProduct ->title }}</td>
<td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
<td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->price }}</td>
</tr>
@endforeach
</tbody>
</table>


<p>Total Amount: ${{ number_format($details->total_amount, 2) }}</p>
<p>Payment Method: {{ $details->payment_method }}</p>
<p>Thank you for choosing <strong>E-Commerce</strong>. We appreciate your business.</p>
Thanks,<br>
@endcomponent







