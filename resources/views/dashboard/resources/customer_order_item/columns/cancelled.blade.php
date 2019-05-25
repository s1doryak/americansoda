@if(is_ajax())
    @if($model->cancelled)
        <span class="c-red">CANCELLED</span>
    @else
        <s class="c-gray">CANCELLED</s>
    @endif
@else
    @if($model->cancelled)
        CANCELLED
    @else
        NO-CANCELLED
    @endif
@endif