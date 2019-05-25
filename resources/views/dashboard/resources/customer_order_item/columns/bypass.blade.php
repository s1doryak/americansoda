@if(is_ajax())
    @if($model->bypass)
        <span class="c-blue">BYPASS</span>
    @else
        <s class="c-gray">BYPASS</s>
    @endif
@else
    @if($model->bypass)
        BYPASS
    @else
        NO-BYPASS
    @endif
@endif