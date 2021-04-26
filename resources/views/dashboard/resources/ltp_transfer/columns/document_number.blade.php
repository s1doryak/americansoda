{{ $model->document_number }}
@if($model->updated_at instanceof \Carbon\Carbon)
    @if($model->updated_at->diffInMinutes(\Carbon\Carbon::now()) <= 60)
        <div class="badge-circle s-small bgm-green" data-toggle="tooltip" data-placement="right" title="{{ trans('material-admin::datatables.badges.recently_updated') }}"></div>
    @endif
@endif
