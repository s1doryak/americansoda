@extends('dashboard::actions.show')

@section('modal-content')
    <pre>
        {{ base64_decode($model->content) }}
    </pre>
@endsection
