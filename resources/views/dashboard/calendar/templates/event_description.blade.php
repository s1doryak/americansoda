@if (isset($editable))
    <p><u>Previous</u> order: <a href="{{ generateResourceLink($customerOrder->id, 'customer_order') }}"
                                 target="_blank">{{ $customerOrder->number }}</a></p>
@else
    <p>Order: <a href="{{ generateResourceLink($customerOrder->id, 'customer_order') }}"
                 target="_blank">{{ $customerOrder->number }}</a></p>
    <p>Status: {{ $customerOrder->status }}</p>
@endif
<hr>
<p>Customer: <a href="{{ generateResourceLink($customerOrder->customer->id, 'customer') }}"
                target="_blank">{{ $customerOrder->customer->name }}</a></p>
<p>Address: {{ $customerOrder->customer->address1 }}</p>
<p>Phone: {{ $customerOrder->customer->phone }}</p>
<p>E-mail: <a href="mailto:{{ $customerOrder->customer->email }}"
              target="_blank">{{ $customerOrder->customer->email }}</a></p>
