@extends('dashboard::actions.index')

@section('buttons')
    <div class="buttons">
        {!! link_to_route('dashboard.stock_movement.create', trans('models/stock_movement.labels.create'), [], ['class' => 'btn btn-link btn-primary btn-sm']) !!}
    </div>
@stop

@section('scripts')
    @parent
    <style type="text/css">
        .table .green, .table .red {
            font-weight: bold;
        }

        .table .green {
            color: green;
        }

        .table .red {
            color: red;
        }
    </style>
@stop
