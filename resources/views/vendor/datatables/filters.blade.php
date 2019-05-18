@if($filters->count())
    <form id="{{ $id }}" class="{{ $class }}" enctype="multipart/form-data" style="display: none;">
        <div class="row">
            @foreach($filters as $idx => $filter)
                @if(view()->exists($filter->template))
                    @include($filter->template, compact('filter'))
                @else
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">{{ $filter->title }}</label>
                        <div class="col-sm-8">
                            @include(sprintf('datatables::filters.%s', $filter->type), compact('filter'))
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-primary btn-sm waves-effect">{{ trans('material-admin::forms.buttons.apply') }}</button>
                    <button type="reset" class="btn btn-danger btn-sm waves-effect m-l-10">{{ trans('material-admin::forms.buttons.reset') }}</button>
                </div>
            </div>
        </div>
    </form>
@endif