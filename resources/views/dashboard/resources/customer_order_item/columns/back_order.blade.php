@if(is_ajax())
    @if($model->back_order)
        <span class="c-red">BACKORDER</span>
    @else
        <s class="c-gray">BACKORDER</s>
    @endif
@else
    @if($model->back_order)
        BACKORDER
    @else
        NO-BACKORDER
    @endif
@endif