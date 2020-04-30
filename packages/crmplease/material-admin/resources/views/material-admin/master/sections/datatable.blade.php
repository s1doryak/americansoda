<div class="card m-b-30">
    <div class="filters-responsive">
        {!! $dataTable->form() !!}
    </div>

    <div class="table-responsive">
        {!! $dataTable->table([], true) !!}
    </div>
</div>

@section('scripts')
    @parent
    {!! $dataTable->scripts() !!}
@stop
