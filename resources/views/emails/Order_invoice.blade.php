@component('vendor.mail.html.message')

<p>Dear {{ $Order->first_name }},</p>
<p>Thank you for your recent purchase with <strong>E-Commerce</strong>. We are pleased to confirm your order. </p>
<h3>Order Details:</h3>
<ul>
<li>Order Number: {{ $Order->id }}</li>
 <li>Date of Purchase: {{ $Order->created_at }}</li>
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
@foreach ($Order->getItem as $item)
<tr>
<td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->getProduct ->title }}</td>
<td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
<td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->price }}</td>
</tr>
@endforeach
</tbody>
</table>


<p>Total Amount: ${{ number_format($Order->total_amount, 2) }}</p>
<p>Payment Method: {{ $Order->payment_method }}</p>
<p>Thank you for choosing <strong>E-Commerce</strong>. We appreciate your business.</p>
Thanks,<br>
@endcomponent







