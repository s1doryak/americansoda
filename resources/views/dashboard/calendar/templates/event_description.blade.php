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
<p>Address: {{ sprintf('%s, %s', $customerOrder->customer->shipping_address, $customerOrder->customer->shipping_postcode) }}</p>
<p>Phone: {{ $customerOrder->customer->phone }}</p>
<p>E-mail: <a href="mailto:{{ $customerOrder->customer->email }}"
              target="_blank">{{ $customerOrder->customer->email }}</a></p>


<div class="form-group">
    <div class="fg-line">
        <div data-name="event-description"></div>
    </div>
</div>

<div class="form-group">
    <div class="fg-line">
                                <textarea class="form-control auto-size html-editor" name="event-comment"
                                          placeholder="{{ trans('calendar.event.placeholder.comment') }}"
                                          rows="6"></textarea>
    </div>
</div>
<input type="hidden" name="event-id">
<input type="hidden" name="event-type">
<input type="hidden" name="event-start">