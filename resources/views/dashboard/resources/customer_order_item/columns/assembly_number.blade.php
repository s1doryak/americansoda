@if($model->back_order)
    <span class="text-muted">BACKORDER</span>
@else
    @if($model->hasValidAssemblyNumber())
        {{ $model->getAssemblyNumber() }}
    @else
        @if($model->hasDefaultAssemblyNumber())
            <div class="toggle-switch" data-ts-color="green">
                <input type="checkbox" id="shipment_assign[{{ $model->getKey() }}]" data-action="shipment_assign" data-url="{!! route('dashboard.customer_order_item.shipment.assign', $model->getKey()) !!}" data-method="post" data-token="{{ csrf_token() }}" checked="checked">
                <label for="shipment_assign[{{ $model->getKey() }}]" class="ts-helper"></label>
            </div>
        @else
            <div class="toggle-switch" data-ts-color="green">
                <input type="checkbox" id="shipment_assign[{{ $model->getKey() }}]" data-action="shipment_assign" data-url="{!! route('dashboard.customer_order_item.shipment.assign', $model->getKey()) !!}" data-method="post" data-token="{{ csrf_token() }}">
                <label for="shipment_assign[{{ $model->getKey() }}]" class="ts-helper"></label>
            </div>
        @endif
    @endif
@endif
