@if($model->maventa_paid)
    <div class="toggle-switch disabled" data-ts-color="green">
        <input type="checkbox" id="maventa_paid[{{ $model->getKey() }}]"
               data-action="maventa_paid"
               data-url="{!! route('dashboard.customer_invoice.maventa_paid', $model->getKey()) !!}"
               data-method="post"
               data-token="{{ csrf_token() }}"
               checked="checked"
               disabled="disabled">
        <label for="maventa_paid[{{ $model->getKey() }}]" class="ts-helper"></label>
    </div>
@else
    <div class="toggle-switch" data-ts-color="green">
        <input type="checkbox" id="maventa_paid[{{ $model->getKey() }}]"
               data-action="maventa_paid"
               data-url="{!! route('dashboard.customer_invoice.maventa_paid', $model->getKey()) !!}"
               data-method="post"
               data-token="{{ csrf_token() }}">
        <label for="maventa_paid[{{ $model->getKey() }}]" class="ts-helper"></label>
    </div>
@endif
