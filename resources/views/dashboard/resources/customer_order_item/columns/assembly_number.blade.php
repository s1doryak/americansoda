@if($model->back_order)
    <span class="text-muted">BACKORDER</span>
@else
    @if($model->hasValidAssemblyNumber())
        {{ $model->getAssemblyNumber() }}
    @else
        @if($model->hasDefaultAssemblyNumber())
            <div class="toggle-switch" data-ts-color="green">
                <input type="checkbox" data-action="shipment_assign" data-url="{!! route('dashboard.customer_order_item.shipment.assign', $model->getKey()) !!}" data-token="{{ csrf_token() }}" checked="checked">
                <label for="checkable" class="ts-helper"></label>
            </div>
        @else
            <div class="toggle-switch" data-ts-color="green">
                <input type="checkbox" data-action="shipment_assign" data-url="{!! route('dashboard.customer_order_item.shipment.assign', $model->getKey()) !!}" data-token="{{ csrf_token() }}">
                <label for="checkable" class="ts-helper"></label>
            </div>
        @endif
    @endif
@endif