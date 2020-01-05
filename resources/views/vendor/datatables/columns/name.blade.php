@if($model->color)
    <div class="badge-circle" style="background: {{ $model->color }}"></div>
@endif
{{ $model->name }}
@if($model->updated_at instanceof \Carbon\Carbon)
    @if($model->updated_at->isToday())
        <div class="badge-circle s-small bgm-green" data-toggle="tooltip" data-placement="right" title="{{ trans('material-admin::datatables.badges.recently_updated') }}"></div>
    @endif
@endif
