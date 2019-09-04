@if($filters->count())
    <form id="{{ $id }}" class="{{ $class }}" enctype="multipart/form-data" style="display: none;">
        <div class="row p-t-30">
            @foreach($filters as $idx => $filter)
                @php($data = compact('filter'))
                @if(view()->exists($view = $filter->template))
                    @include($view, $data)
                @else
                    @if(view()->exists($view = sprintf('datatables::filters.%s', $filter->type)))
                        <div class="form-group col-sm-6">
                            <label class="col-sm-4 control-label">{{ $filter->title }}</label>
                            <div class="col-sm-8">
                                @include($view, $data)
                            </div>
                        </div>
                    @else
                        <div class="form-group col-sm-6">
                            <label class="col-sm-4 control-label">{{ $filter->title }}</label>
                            <div class="col-sm-8">
                                @include('datatables::filters.text', $data)
                            </div>
                        </div>
                    @endif
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
